<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function guru() {
        return $this->belongsTo(Guru::class, 'guruId', 'id');
    }

    public function tipe() {
        return $this->belongsTo(TipePengumuman::class, 'tipeId', 'id');
    }
}
