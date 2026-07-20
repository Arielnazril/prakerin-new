<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Placement;
use App\Models\Penilaian;
use Barryvdh\DomPDF\Facade\Pdf; // 1. TAMBAHKAN IMPORT DOMPDF INI

class TranskripController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $placement = Placement::where('siswa_id', $user->id)
            ->where('status', '!=', 'dibatalkan')
            ->with(['instansi', 'mentor', 'guru'])
            ->first();

        if (!$placement) {
            return redirect()->route('dashboard')->with('error', 'Anda belum memiliki penempatan magang.');
        }

        $nilaiMentor = Penilaian::where('placement_id', $placement->id)
            ->whereHas('penilai', fn($q) => $q->where('role', 'industri'))
            ->first();

        $nilaiGuru = Penilaian::where('placement_id', $placement->id)
            ->whereHas('penilai', fn($q) => $q->where('role', 'guru'))
            ->first();

        return view('siswa.transkrip.index', compact('placement', 'nilaiMentor', 'nilaiGuru'));
    }

    public static function getPredikat($nilai)
    {
        if ($nilai >= 90) return 'A (Sangat Baik)';
        if ($nilai >= 80) return 'B (Baik)';
        if ($nilai >= 70) return 'C (Cukup)';
        if ($nilai >= 60) return 'D (Kurang)';
        return 'E (Tidak Lulus)';
    }

    // 2. TAMBAHKAN METHOD INI DI BAGIAN BAWAH
    public function cetakSertifikat($id)
    {
        $placement = Placement::with(['instansi', 'mentor', 'guru', 'siswa'])->findOrFail($id);

        // Validasi Keamanan: Pastikan sertifikat milik siswa yang sedang login & statusnya selesai/is_completed
        if ($placement->siswa_id !== Auth::id() || !$placement->is_completed) {
            abort(403, 'Akses ditolak atau sertifikat belum diterbitkan.');
        }

        // Render PDF halaman landscape ukuran A4
        $pdf = Pdf::loadView('siswa.sertifikat_pdf', compact('placement'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('Sertifikat_Magang_' . Auth::user()->name . '.pdf');
    }
}