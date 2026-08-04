<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Placement;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\PenempatanKalkulasi; // Import model permanen kalkulasi
use App\Services\FuzzySawService;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk query hitung kuota

class PlacementController extends Controller
{
    protected $fuzzySawService;

    public function __construct(FuzzySawService $fuzzySawService)
    {
        $this->fuzzySawService = $fuzzySawService;
    }

    public function index()
    {
        $placements = Placement::with(['siswa', 'guru', 'instansi', 'mentor'])->latest()->get();
        return view('admin.placement.index', compact('placements'));
    }

    public function create()
    {
        $siswaTerdaftar = Placement::pluck('siswa_id')->toArray();
        $siswas = User::where('role', 'siswa')
            ->where('status_akun', 'aktif')
            ->whereNotIn('id', $siswaTerdaftar)
            ->get();

        $gurus = User::where('role', 'guru')->get();
        $instansis = Instansi::all();
        $mentors = User::where('role', 'industri')->get();

        return view('admin.placement.create', compact('siswas', 'gurus', 'instansis', 'mentors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'guru_id' => 'required|exists:users,id',
            'instansi_id' => 'required|exists:instansis,id',
            'mentor_id' => 'nullable|exists:users,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        if ($request->mentor_id) {
            $cekMentor = User::find($request->mentor_id);
            if ($cekMentor->instansi_id != $request->instansi_id) {
                return back()->with('error', 'Mentor tidak sesuai instansi!');
            }
        }

        Placement::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $request->guru_id,
            'instansi_id' => $request->instansi_id,
            'mentor_id' => $request->mentor_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'aktif'
        ]);

        User::where('id', $request->siswa_id)->update(['instansi_id' => $request->instansi_id]);

        return redirect()->route('admin.placement.index')->with('success', 'Berhasil menentukan tempat magang & mentor siswa!');
    }

    public function edit($id)
    {
        $placement = Placement::findOrFail($id);
        $gurus = User::where('role', 'guru')->get();

        $mentors = User::where('role', 'industri')
            ->where('instansi_id', $placement->instansi_id)
            ->get();

        return view('admin.placement.edit', compact('placement', 'gurus', 'mentors'));
    }

    public function update(Request $request, $id)
    {
        $placement = Placement::findOrFail($id);

        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'mentor_id' => 'required|exists:users,id',
        ]);

        $placement->update([
            'guru_id' => $request->guru_id,
            'mentor_id' => $request->mentor_id,
        ]);

        return redirect()->route('admin.placement.index')->with('success', 'Data Pembimbing berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $placement = Placement::findOrFail($id);

        User::where('id', $placement->siswa_id)->update(['instansi_id' => null]);

        $placement->delete();

        return back()->with('success', 'Data penempatan dibatalkan/dihapus');
    }

    /**
     * Menghapus seluruh data penempatan magang sekaligus dan mereset instansi siswa
     */
    public function destroyAll()
    {
        // Ambil semua ID siswa yang sedang di-plotting
        $siswaIds = Placement::pluck('siswa_id')->toArray();

        // Reset instansi_id seluruh siswa terkait menjadi null
        if (!empty($siswaIds)) {
            User::whereIn('id', $siswaIds)->update(['instansi_id' => null]);
        }

        // Hapus seluruh record dari tabel placements
        Placement::query()->delete();

        return redirect()->route('admin.placement.index')->with('success', 'Semua data penempatan berhasil dihapus');
    }

    public function rekap()
    {
        $placements = Placement::with(['siswa', 'instansi', 'guru'])
            ->latest()
            ->get();

        return view('admin.placement.rekap', compact('placements'));
    }

    public function finalize($id)
    {
        $placement = Placement::findOrFail($id);

        $nilaiMentor = Penilaian::where('placement_id', $id)
            ->whereHas('penilai', fn($q) => $q->where('role', 'industri'))
            ->first();

        $nilaiGuru = Penilaian::where('placement_id', $id)
            ->whereHas('penilai', fn($q) => $q->where('role', 'guru'))
            ->first();

        if (!$nilaiMentor || !$nilaiGuru) {
            return back()->with('error', 'Gagal Finalisasi! Pastikan Mentor DAN Guru sudah memberi nilai.');
        }

        $nilaiAkhir = ($nilaiMentor->nilai_akhir + $nilaiGuru->nilai_akhir) / 2;

        $placement->update([
            'nilai_akhir_total' => $nilaiAkhir,
            'is_completed' => true,
            'status' => 'selesai'
        ]);

        return back()->with('success', 'Nilai berhasil dikunci. Siswa dinyatakan lulus magang.');
    }

    /**
     * Menampilkan Halaman Kalkulasi & Data Terkalkulasi dari Database MySQL (Permanen)
     */
    public function calculate()
    {
        // Ambil daftar ID siswa yang SUDAH DITEMPATKAN di tabel placements
        $siswaDitempatkanIds = Placement::pluck('siswa_id')->toArray();

        // Ambil HANYA siswa aktif yang BELUM DITEMPATKAN
        $siswaAktif = User::where('role', 'siswa')
            ->where('status_akun', 'aktif')
            ->whereNotIn('id', $siswaDitempatkanIds)
            ->get();

        $siswas = $siswaAktif;

        // Ambil hasil kalkulasi yang tersimpan permanen di database MySQL
        $kalkulasis = PenempatanKalkulasi::with('siswa')->latest()->get();

        $instansis = Instansi::all();

        // Menghitung rekap kuota terpakai riwayat penempatan dari database berdasarkan nama instansi
        $kuotaTerpakaiDB = Placement::join('instansis', 'placements.instansi_id', '=', 'instansis.id')
            ->select('instansis.nama_perusahaan', DB::raw('count(*) as total'))
            ->where('placements.status', 'aktif')
            ->groupBy('instansis.nama_perusahaan')
            ->pluck('total', 'nama_perusahaan')
            ->toArray();

        return view('admin.placement.calculate', compact('siswaAktif', 'siswas', 'kalkulasis', 'instansis', 'kuotaTerpakaiDB', 'siswaDitempatkanIds'));
    }

    /**
     * Menyimpan atau Meng-update Hasil Perhitungan SPK Secara PERMANEN ke Database MySQL
     */
    public function storeKalkulasi(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'c1'       => 'required|numeric',
            'c2'       => 'required|numeric',
        ]);

        $c1 = (float) $request->c1;
        $c2 = (float) $request->c2;

        // Logika Fuzzy Sugeno
        $hardSkill = "Kurang";
        if ($c1 >= 80) $hardSkill = "Baik";
        elseif ($c1 >= 70) $hardSkill = "Cukup";

        $softSkill = "Kurang";
        if ($c2 >= 85) $softSkill = "Sangat Baik";
        elseif ($c2 >= 70) $softSkill = "Cukup";

        $fuzzyScore = 0.5;
        $grade = "B";
        $rule = "Rule 1";

        if ($hardSkill === "Cukup" && $softSkill === "Sangat Baik") { $fuzzyScore = 1.0; $grade = "A"; $rule = "Rule 6"; }
        elseif ($hardSkill === "Baik" && $softSkill === "Cukup") { $fuzzyScore = 1.0; $grade = "A"; $rule = "Rule 8"; }
        elseif ($hardSkill === "Baik" && $softSkill === "Sangat Baik") { $fuzzyScore = 1.0; $grade = "A"; $rule = "Rule 9"; }

        // Logika SAW
        $r1 = $c1 / 100;
        $r2 = $c2 / 100;
        $finalScore = (0.6 * $r1) + (0.4 * $r2);

        // Simpan Permanen ke MySQL
        PenempatanKalkulasi::updateOrCreate(
            ['siswa_id' => $request->siswa_id],
            [
                'c1'                   => $c1,
                'c2'                   => $c2,
                'fuzzy_score'          => $fuzzyScore,
                'grade'                => $grade,
                'rule'                 => $rule,
                'final_score'          => round($finalScore, 2),
                'instansi_rekomendasi' => $request->instansi_rekomendasi ?? null,
            ]
        );

        return redirect()->back()->with('success', 'Data kalkulasi berhasil disimpan secara permanen!');
    }

    /**
     * Menghapus Data Kalkulasi dari Database MySQL
     */
    public function destroyKalkulasi($id)
    {
        $kalkulasi = PenempatanKalkulasi::findOrFail($id);
        $kalkulasi->delete();

        return redirect()->back()->with('success', 'Data kalkulasi berhasil dihapus!');
    }
}