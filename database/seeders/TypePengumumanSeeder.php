<?php

namespace Database\Seeders;

use App\Models\TipePengumuman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Pengumuman', 'KJP', 'Pendataan', 'Lainnya'
        ];

        foreach ($data as $item) {
            TipePengumuman::create([
                'tipe' => $item
            ]);
        }
    }
}
