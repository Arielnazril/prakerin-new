<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    /**
     * Relasi ke Mentor
     */
    public function mentors()
    {
        return $this->hasMany(User::class, 'instansi_id');
    }

    /**
     * Relasi ke Siswa Magang / Pengajuan Magang
     */
    public function siswa()
    {
        // Pilihan A: Jika siswa langsung terhubung ke instansi via foreign key 'instansi_id' di tabel users/siswas
        return $this->hasMany(User::class, 'instansi_id')->where('role', 'siswa');

        // Pilihan B: Jika data siswa magang terhubung melalui tabel Pengajuan/Pendaftaran
        // return $this->hasMany(Pengajuan::class, 'instansi_id');
    }
}