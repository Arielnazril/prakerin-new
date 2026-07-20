<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Placement;
use App\Models\Logbook;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Penilaian;

class DashboardController extends Controller
{
    /**
     * Redirector Utama: Menentukan user ini harus ke dashboard mana.
     * Diakses lewat route: /dashboard
     */
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return $this->adminDashboard();
        } elseif ($role === 'siswa') {
            return $this->siswaDashboard();
        } elseif ($role === 'guru') {
            return $this->guruDashboard();
        } elseif ($role === 'industri') {
            return $this->industriDashboard();
        }

        return abort(403, 'Role tidak dikenali');
    }

    // =========================================================================
    // 1. DASHBOARD ADMIN
    // =========================================================================
    private function adminDashboard()
    {
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalIndustri = Instansi::count();
        $siswaMagang = Placement::where('status', 'aktif')->count();
        
        // KUNCI PERBAIKAN: Mengubah role pencarian menjadi 'industri' agar sinkron dengan database Anda
        $totalMentor = User::where('role', 'industri')->count(); 

        $siswaPending = User::where('role', 'siswa')
            ->where('status_akun', 'pending')
            ->with('jurusan')
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalIndustri',
            'siswaMagang',
            'siswaPending',
            'totalMentor' // <-- Menyertakan variabel ke dalam compact view
        ));
    }

    /**
     * Verifikasi Siswa (Tombol 'Terima' di Dashboard Admin)
     */
    public function verifySiswa($id)
    {
        $siswa = User::findOrFail($id);

        if ($siswa->role !== 'siswa') {
            return back()->with('error', 'User ini bukan siswa!');
        }

        $siswa->update(['status_akun' => 'aktif']);

        return back()->with('success', 'Akun siswa ' . $siswa->name . ' berhasil diaktifkan.');
    }

    /**
     * ACTION: Tolak Siswa (Tombol 'Tolak' di Dashboard Admin)
     */
    public function rejectSiswa($id)
    {
        $siswa = User::findOrFail($id);

        $siswa->delete();

        return back()->with('success', 'Pendaftaran siswa ditolak dan data dihapus.');
    }


    // =========================================================================
    // 2. DASHBOARD SISWA
    // =========================================================================
    private function siswaDashboard()
    {
        $user = Auth::user();

        if ($user->status_akun !== 'aktif') {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('error', 'Akun Anda belum diaktifkan Admin.');
        }

        $placement = Placement::with(['instansi', 'mentor', 'guru'])
            ->where('siswa_id', $user->id)
            ->where('status', 'aktif')
            ->first();

        $logbookSummary = [
            'total' => Logbook::where('user_id', $user->id)->count(),
            'pending' => Logbook::where('user_id', $user->id)->where('status', 'pending')->count(),
            'disetujui' => Logbook::where('user_id', $user->id)->where('status', 'disetujui')->count(),
        ];

        return view('siswa.dashboard', compact('placement', 'logbookSummary'));
    }


    // =========================================================================
    // 3. DASHBOARD GURU
    // =========================================================================
    private function guruDashboard()
    {
        $guruId = Auth::id();

        // 1. Ambil penempatan (placement) yang berstatus AKTIF milik guru ini
        $activePlacements = Placement::where('guru_id', $guruId)
            ->where('status', 'aktif');

        // Mengambil ID siswa aktif untuk keperluan logbook dan total siswa
        $siswaIds = (clone $activePlacements)->pluck('siswa_id');
        $totalSiswa = $siswaIds->count();

        // Mengambil ID placement yang aktif saja
        $placementIds = (clone $activePlacements)->pluck('id');

        // 2. Hitung siswa yang SUDAH dinilai (Memastikan kolom nilai tidak NULL)
        // Catatan: Ganti 'nilai_akhir' sesuai dengan nama kolom nilai sekolah di database Anda (misal: 'nilai', 'nilai_sekolah', dll)
        $sudahDinilai = Penilaian::whereIn('placement_id', $placementIds)
            ->where('penilai_id', $guruId)
            ->whereNotNull('nilai_akhir') // <--- KUNCI PERBAIKAN: Hanya hitung jika nilainya TIDAK KOSONG
            ->count();

        // 3. Hitung yang belum dinilai
        $belumDinilai = $totalSiswa - $sudahDinilai;

        // 4. Mengambil logbook terbaru
        $recentLogbooks = Logbook::whereIn('user_id', $siswaIds)
            ->with('siswa')
            ->latest()
            ->take(5)
            ->get();

        return view('guru.dashboard', compact('totalSiswa', 'sudahDinilai', 'belumDinilai', 'recentLogbooks'));
    }

    // =========================================================================
    // 4. DASHBOARD INDUSTRI (MENTOR)
    // =========================================================================
    private function industriDashboard()
    {
        $mentorId = Auth::id();

        // Mengambil data penempatan siswa bimbingan mentor ini
        $placements = Placement::where('mentor_id', $mentorId)
            ->with('siswa')
            ->where('status', 'aktif')
            ->get();

        $siswaIds = $placements->pluck('siswa_id');

        // 1. MENGAKTIFKAN CARD TOTAL SISWA BIMBINGAN
        $totalSiswa = $siswaIds->count();

        // 2. MENGAKTIFKAN CARD BUTUH VALIDASI
        $logbookPending = Logbook::whereIn('user_id', $siswaIds)
            ->where('status', 'pending')
            ->count();

        // 3. MENGAKTIFKAN CARD TOTAL AKTIVITAS
        $totalLogbook = Logbook::whereIn('user_id', $siswaIds)
            ->count();

        // 4. MENGIRIM VARIABEL RECENT LOGBOOKS
        $recentLogbooks = Logbook::whereIn('user_id', $siswaIds)
            ->with('siswa') // Memastikan relasi siswa ikut termuat untuk card Aktivitas Logbook
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        // Mengirimkan semua variabel ke halaman view industri.dashboard
        return view('industri.dashboard', compact(
            'placements', // Diubah agar sinkron dengan variabel $placements di file Blade sebelumnya
            'logbookPending', 
            'totalSiswa', 
            'totalLogbook', 
            'recentLogbooks'
        ));
    }
}