<?php

namespace App\Services;

class FuzzySawService
{
    /**
     * Fuzzifikasi C1 (Nilai Akademik / Aspek Teknis)
     */
    private function fuzzifyC1($x)
    {
        $kurang = 0;
        if ($x <= 50) $kurang = 1;
        elseif ($x > 50 && $x < 70) $kurang = (70 - $x) / (70 - 50);

        $cukup = 0;
        if ($x > 50 && $x <= 70) $cukup = ($x - 50) / (70 - 50);
        elseif ($x > 70 && $x < 85) $cukup = (85 - $x) / (85 - 70);

        $sangatBaik = 0;
        if ($x >= 70 && $x <= 85) $sangatBaik = ($x - 70) / (85 - 70);
        elseif ($x > 85) $sangatBaik = 1;

        return [
            'kurang' => $kurang,
            'cukup' => $cukup,
            'sangat_baik' => $sangatBaik
        ];
    }

    /**
     * Fuzzifikasi C2 (Kehadiran / Aspek Non-Teknis)
     */
    private function fuzzifyC2($y)
    {
        $kurang = 0;
        if ($y <= 50) $kurang = 1;
        elseif ($y > 50 && $y < 70) $kurang = (70 - $y) / (70 - 50);

        $cukup = 0;
        if ($y > 50 && $y <= 70) $cukup = ($y - 50) / (70 - 50);
        elseif ($y > 70 && $y < 85) $cukup = (85 - $y) / (85 - 70);

        $sangatBaik = 0;
        if ($y >= 70 && $y <= 85) $sangatBaik = ($y - 70) / (85 - 70);
        elseif ($y > 85) $sangatBaik = 1;

        return [
            'kurang' => $kurang,
            'cukup' => $cukup,
            'sangat_baik' => $sangatBaik
        ];
    }

    /**
     * Inferensi & Defuzzifikasi Sugeno
     */
    public function calculateFuzzySugeno($c1, $c2)
    {
        $fuzC1 = $this->fuzzifyC1($c1);
        $fuzC2 = $this->fuzzifyC2($c2);

        // 9 Aturan Sugeno
        $rules = [
            ['alpha' => min($fuzC1['kurang'], $fuzC2['kurang']), 'z' => 50],
            ['alpha' => min($fuzC1['kurang'], $fuzC2['cukup']), 'z' => 50],
            ['alpha' => min($fuzC1['kurang'], $fuzC2['sangat_baik']), 'z' => 75],
            
            ['alpha' => min($fuzC1['cukup'], $fuzC2['kurang']), 'z' => 50],
            ['alpha' => min($fuzC1['cukup'], $fuzC2['cukup']), 'z' => 75],
            ['alpha' => min($fuzC1['cukup'], $fuzC2['sangat_baik']), 'z' => 95],
            
            ['alpha' => min($fuzC1['sangat_baik'], $fuzC2['kurang']), 'z' => 75],
            ['alpha' => min($fuzC1['sangat_baik'], $fuzC2['cukup']), 'z' => 95],
            ['alpha' => min($fuzC1['sangat_baik'], $fuzC2['sangat_baik']), 'z' => 95],
        ];

        $top = 0;
        $bottom = 0;

        foreach ($rules as $rule) {
            $top += ($rule['alpha'] * $rule['z']);
            $bottom += $rule['alpha'];
        }

        return $bottom > 0 ? round($top / $bottom, 2) : 50;
    }

    /**
     * Pemrosesan SAW & Perangkingan
     */
    public function processFuzzySaw($dataSiswa)
    {
        if (empty($dataSiswa)) return [];

        $processed = [];

        foreach ($dataSiswa as $siswa) {
            $fuzzyScore = $this->calculateFuzzySugeno($siswa['c1'], $siswa['c2']);
            $processed[] = [
                'id' => $siswa['id'],
                'nama' => $siswa['nama'],
                'c1' => $siswa['c1'],
                'c2' => $siswa['c2'],
                'fuzzy_score' => $fuzzyScore,
            ];
        }

        $maxFuzzy = max(array_column($processed, 'fuzzy_score')) ?: 1;
        $maxC1 = max(array_column($processed, 'c1')) ?: 1;

        $w1 = 0.6; // Bobot Fuzzy
        $w2 = 0.4; // Bobot Akademik

        foreach ($processed as &$s) {
            $r1 = $s['fuzzy_score'] / $maxFuzzy;
            $r2 = $s['c1'] / $maxC1;

            $s['r1'] = round($r1, 4);
            $s['r2'] = round($r2, 4);
            $s['final_score'] = round(($r1 * $w1) + ($r2 * $w2), 4);
        }

        // Urutkan Peringkat Tertinggi ke Terendah
        usort($processed, function ($a, $b) {
            return $b['final_score'] <=> $a['final_score'];
        });

        return $processed;
    }
}