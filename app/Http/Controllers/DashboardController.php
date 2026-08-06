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
        
        $totalMentor = User::where('role', 'industri')->count(); 

        $siswaPending = User::where('role', 'siswa')
            ->where('status_akun', 'pending')
            ->with('jurusan')
            ->latest()
            ->get();

        $instansis = Instansi::all()->map(function ($instansi) {
            $instansi->terpakai_count = Placement::where('instansi_id', $instansi->id)
                ->where('status', 'aktif')
                ->count();
            return $instansi;
        });

        // KUNCI PEMISAHAN DATA GRADE A & GRADE B
        $instansiGradeA = $instansis->filter(function ($instansi, $index) {
            $dbGrade = strtoupper($instansi->akreditasi ?? $instansi->grade ?? $instansi->kategori ?? '');
            return $dbGrade === 'A' || ($dbGrade === '' && $index % 2 === 0);
        });

        $instansiGradeB = $instansis->filter(function ($instansi, $index) {
            $dbGrade = strtoupper($instansi->akreditasi ?? $instansi->grade ?? $instansi->kategori ?? '');
            return $dbGrade === 'B' || ($dbGrade === '' && $index % 2 !== 0);
        });

        $totalGradeA = $instansiGradeA->count();
        $totalGradeB = $instansiGradeB->count();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalIndustri',
            'siswaMagang',
            'siswaPending',
            'totalMentor',
            'instansis',
            'instansiGradeA',
            'instansiGradeB',
            'totalGradeA',
            'totalGradeB'
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

        $activePlacements = Placement::where('guru_id', $guruId)
            ->where('status', 'aktif');

        $siswaIds = (clone $activePlacements)->pluck('siswa_id');
        $totalSiswa = $siswaIds->count();

        $placementIds = (clone $activePlacements)->pluck('id');

        $sudahDinilai = Penilaian::whereIn('placement_id', $placementIds)
            ->where('penilai_id', $guruId)
            ->whereNotNull('nilai_akhir')
            ->count();

        $belumDinilai = $totalSiswa - $sudahDinilai;

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

        $placements = Placement::where('mentor_id', $mentorId)
            ->with('siswa')
            ->where('status', 'aktif')
            ->get();

        $siswaIds = $placements->pluck('siswa_id');

        $totalSiswa = $siswaIds->count();

        $logbookPending = Logbook::whereIn('user_id', $siswaIds)
            ->where('status', 'pending')
            ->count();

        $totalLogbook = Logbook::whereIn('user_id', $siswaIds)
            ->count();

        $recentLogbooks = Logbook::whereIn('user_id', $siswaIds)
            ->with('siswa')
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        return view('industri.dashboard', compact(
            'placements',
            'logbookPending', 
            'totalSiswa', 
            'totalLogbook', 
            'recentLogbooks'
        ));
    }
}