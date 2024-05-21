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
        Schema::create('pengumumen', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('guruId')->nullable();
            $table->foreign('guruId')->references('id')->on('gurus')->nullOnDelete();

            $table->unsignedBigInteger('tipeId')->nullable();
            $table->foreign('tipeId')->references('id')->on('tipe_pengumumen')->nullOnDelete();

            $table->string('judul');
            $table->text('deskripsi');
            $table->string('keterangan')->nullable();
            $table->string('gambar')->nullable();

            $table->date('tanggal');
            $table->time('waktu');

            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumen');
    }
};
