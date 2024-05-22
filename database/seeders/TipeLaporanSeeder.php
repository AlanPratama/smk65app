<?php

namespace Database\Seeders;

use App\Models\TipeLaporan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Pembulian', 'Perkelahian', 'Fasilitas', 'Pengumuman', 'Asusila', 'Lainnya'
        ];

        foreach ($data as $item) {
            TipeLaporan::create([
                'tipe' => $item
            ]);
        }
    }
}
