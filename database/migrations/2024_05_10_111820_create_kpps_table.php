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
        Schema::create('kpps', function (Blueprint $table) {
            $table->id();

            $table->enum('tipe', ['Prestasi', 'Pelanggaran']);
            $table->string('judul');
            $table->integer('poin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpps');
    }
};
