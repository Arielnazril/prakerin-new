<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenempatanKalkulasi extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'penempatan_kalkulasis';

    // Kolom-kolom yang diizinkan untuk diisi data secara massal
    protected $fillable = [
        'siswa_id',
        'c1',
        'c2',
        'fuzzy_score',
        'grade',
        'rule',
        'final_score',
        'instansi_rekomendasi',
    ];

    /**
     * Relasi ke model User (karena data siswa disimpan pada tabel/model User)
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}