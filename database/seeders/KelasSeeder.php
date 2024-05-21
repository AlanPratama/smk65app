<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kelas' => 'X-PPLG',
                'guruId' => 1,
                'jadwalPelajaran' => null,
            ],
            [
                'kelas' => 'X-PPLG2',
                'guruId' => 2,
                'jadwalPelajaran' => null,
            ],
            [
                'kelas' => 'XI-PPLG',
                'guruId' => 3,
                'jadwalPelajaran' => null,
            ],
            [
                'kelas' => 'XI-PPLG2',
                'guruId' => 4,
                'jadwalPelajaran' => null,
            ],
            [
                'kelas' => 'XII-PPLG',
                'guruId' => 5,
                'jadwalPelajaran' => null,
            ],
            [
                'kelas' => 'XII-PPLG2',
                'guruId' => 6,
                'jadwalPelajaran' => null,
            ],
        ];

        foreach ($data as $item) {
            Kelas::create($item);
        }
    }
}
