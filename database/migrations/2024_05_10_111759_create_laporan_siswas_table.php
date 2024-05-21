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

            $table->unsignedBigInteger('siswaId')->nullable();
            $table->foreign('siswaId')->references('id')->on('siswas');

            $table->string('judul');
            $table->text('deskripsi');
            
            $table->string('keterangan')->nullable();

            $table->date('tanggal');
            $table->time('waktu');

            $table->string('status'); // BTW INI BUAT APA YA
            $table->string('foto');

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
