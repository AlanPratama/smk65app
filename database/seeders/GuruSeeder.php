<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'role' => 'Guru',
                'nip' => '001',
                'telepon' => '085817000941',
                'slug' => 'guru',
                'nama' => 'Guru',
                'username' => 'guru',
                'password' => bcrypt('guru'),
                'proPic' => null,
            ],
            [
                'role' => 'Guru',
                'nip' => '002',
                'telepon' => '085817000942',
                'slug' => 'guru2',
                'nama' => 'Guru 2',
                'username' => 'guru2',
                'password' => bcrypt('guru2'),
                'proPic' => null,
            ],
            [
                'role' => 'Guru',
                'nip' => '003',
                'telepon' => '085817000943',
                'slug' => 'guru3',
                'nama' => 'Guru 3',
                'username' => 'guru3',
                'password' => bcrypt('guru3'),
                'proPic' => null,
            ],
            [
                'role' => 'Guru',
                'nip' => '004',
                'telepon' => '085817000944',
                'slug' => 'guru4',
                'nama' => 'Guru 4',
                'username' => 'guru4',
                'password' => bcrypt('guru4'),
                'proPic' => null,
            ],
            [
                'role' => 'Guru',
                'nip' => '005',
                'telepon' => '085817000945',
                'slug' => 'guru5',
                'nama' => 'Guru 5',
                'username' => 'guru5',
                'password' => bcrypt('guru5'),
                'proPic' => null,
            ],
            [
                'role' => 'Guru',
                'nip' => '006',
                'telepon' => '085817000922',
                'slug' => 'guru6',
                'nama' => 'Guru 6',
                'username' => 'guru6',
                'password' => bcrypt('guru6'),
                'proPic' => null,
            ],
        ];

        foreach ($data as $item) {
            Guru::create($item);            
        }
    }
}
