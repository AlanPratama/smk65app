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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('slug') ;

            $table->unsignedBigInteger('kelasId')->nullable();
            $table->foreign('kelasId')->references('id')->on('kelas');

            $table->integer('nisn');
            $table->string('telepon');
            $table->string('username');
            $table->string('password');
            $table->string('proPic')->nullable();
            $table->enum('role', ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Keamanan', 'Anggota'])->default('Anggota');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
