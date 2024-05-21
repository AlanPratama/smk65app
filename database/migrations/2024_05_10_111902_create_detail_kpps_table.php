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
        Schema::create('detail_kpps', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('siswaId');
            $table->foreign('siswaId')->references('id')->on('siswas')->cascadeOnDelete();
            
            $table->unsignedBigInteger('guruId');
            $table->foreign('guruId')->references('id')->on('gurus')->cascadeOnDelete();
            
            $table->unsignedBigInteger('kppsId');
            $table->foreign('kppsId')->references('id')->on('kpps')->cascadeOnDelete();
            
            $table->date('tanggal');
            $table->time('waktu');

            $table->string('pesan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kpps');
    }
};
