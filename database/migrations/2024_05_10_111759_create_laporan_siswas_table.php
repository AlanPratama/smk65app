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
        Schema::create('laporan_siswas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('siswaId');
            $table->foreign('siswaId')->references('id')->on('siswas');

            $table->unsignedBigInteger('tipeId')->nullable();
            $table->foreign('tipeId')->references('id')->on('tipe_laporans');

            $table->string('judul');
            $table->text('deskripsi');
            
            $table->string('keterangan')->nullable();

            $table->date('tanggal');

            $table->enum('status', ['Publik', 'Privat']); // BTW INI BUAT APA YA
            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_siswas');
    }
};
