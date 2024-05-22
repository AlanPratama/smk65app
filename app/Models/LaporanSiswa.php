<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSiswa extends Model
{
    use HasFactory;

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'siswaId');
    }

    public function tipe() {
        return $this->belongsTo(TipeLaporan::class, 'tipeId');
    }
}
