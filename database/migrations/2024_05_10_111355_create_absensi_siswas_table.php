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
        Schema::create('absensi_siswas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('siswaId');
            $table->foreign('siswaId')->references('id')->on('siswas');

            $table->date('tanggal');
            $table->time('waktu');

            $table->enum('status', ['Masuk', 'Izin', 'Sakit', 'Alpa']);
            $table->string('keterangan')->nullable();
            $table->string('suratIzin')->nullable();
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_siswas');
    }
};
