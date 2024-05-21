<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class SiswaViewController extends Controller
{
    public function beranda()
    {
        $pgMenu = 'Beranda';

        return view('pages.siswa.beranda');
    }

    public function pengumuman()
    {
        $pgMenu = 'Pengumuman';
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->get();

        return view('pages.siswa.pengumuman', compact('pengumuman'));
    }
}
