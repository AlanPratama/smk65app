<?php

namespace App\Http\Controllers;

use App\Models\TipeLaporan;
use App\Models\TipePengumuman;
use Illuminate\Http\Request;

class GuruViewController extends Controller
{
    public function dashboard()
    {
        $pgMenu = 'Dashboard';

        return view('pages.guru.dashboard', compact('pgMenu'));
    }

    public function pengumuman()
    {
        $types = TipePengumuman::all();
        $pgMenu = 'Pengumuman';

        return view('pages.guru.pengumuman.viewGuruPengumuman', compact('types', 'pgMenu'));
    }

    public function laporanSiswa()
    {
        $pgMenu = 'Laporan Siswa';
        $types = TipeLaporan::all();

        return view('pages.guru.laporanSiswa.viewGuruLaporanSiswa', compact('pgMenu', 'types'));
    }

}
