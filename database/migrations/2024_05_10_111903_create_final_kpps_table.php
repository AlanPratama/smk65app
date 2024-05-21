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
        Schema::create('final_kpps', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('siswaId');
            $table->foreign('siswaId')->references('id')->on('siswas')->cascadeOnDelete();
            
            $table->string('kelas');

            $table->integer('prestasiPoin');
            $table->integer('pelanggaranPoin');
            $table->integer('totalPoin');

            $table->date('tanggal');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_kpps');
    }
};
