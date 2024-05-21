<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Alan Pratama Rusfi',
                'slug' => 'alan-pratama-rusfi',
                'kelasId' => 1,
                'nisn' => '002123',
                'telepon' => '085817000942',
                'username' => 'lalan',
                'password' => bcrypt('lalan'),
                'role' => 'Anggota',
            ],
            [
                'nama' => 'Hendri Setiawan',
                'slug' => 'hendri-setiawan',
                'kelasId' => 1,
                'nisn' => '002124',
                'telepon' => '085817000942',
                'username' => 'hendri',
                'password' => bcrypt('hendri'),
                'role' => 'Anggota',
            ],
            [
                'nama' => 'Rizky Purnama',
                'slug' => 'rizky-purnama',
                'kelasId' => 2,
                'nisn' => '002125',
                'telepon' => '085817000943',
                'username' => 'rizky',
                'password' => bcrypt('rizky'),
                'role' => 'Anggota',
            ],
            [
                'nama' => 'Nurul Huda',
                'slug' => 'nurul-huda',
                'kelasId' => 3,
                'nisn' => '002126',
                'telepon' => '085817000944',
                'username' => 'huda',
                'password' => bcrypt('huda'),
                'role' => 'Anggota',
            ],
            [
                'nama' => 'Fajar Aditya',
                'slug' => 'fajar-aditya',
                'kelasId' => 4,
                'nisn' => '002127',
                'telepon' => '085817000945',
                'username' => 'aditya',
                'password' => bcrypt('aditya'),
                'role' => 'Anggota',
            ],
            [
                'nama' => 'Muhammad Rizal',
                'slug' => 'muhammad-rizal',
                'kelasId' => 5,
                'nisn' => '002128',
                'telepon' => '085817000946',
                'username' => 'rizal',
                'password' => bcrypt('rizal'),
                'role' => 'Anggota',
            ],
        ];

        foreach ($data as $item) {
            Siswa::create($item);
        }
    }
}
