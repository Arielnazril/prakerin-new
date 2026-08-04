<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('penempatan_kalkulasis');

        Schema::create('penempatan_kalkulasis', function (Blueprint $table) {
            $table->id();
            
            // Menggunakan unsignedBigInteger biasa agar fleksibel & tidak gagal akibat beda nama tabel
            $table->unsignedBigInteger('siswa_id'); 
            
            $table->float('c1'); 
            $table->float('c2'); 
            $table->float('fuzzy_score');
            $table->string('grade');
            $table->string('rule');
            $table->float('final_score');
            $table->string('instansi_rekomendasi')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatan_kalkulasis');
    }
};