<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      collect([
        [
          'kelompok_mapel_id' => 1,
          'name' => 'Pendidikan Agama Islam dan Budi Pekerti',
          'singkatan' => 'PABP',
        ],
        [
          'kelompok_mapel_id' => 1,
          'name' => 'Pendidikan Pancasila',
          'singkatan' => 'PP',
        ],
        [
          'kelompok_mapel_id' => 1,
          'name' => 'Bahasa Indonesia',
          'singkatan' => 'B.INDO',
        ],
        [
          'kelompok_mapel_id' => 1,
          'name' => 'Ilmu Pengetahuan Alam',
          'singkatan' => 'IPA',
        ],
        [
          'kelompok_mapel_id' => 1,
          'name' => 'Ilmu Pengetahuan Sosial',
          'singkatan' => 'IPS',
        ],
        [
          'kelompok_mapel_id' => 1,
          'name' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan',
          'singkatan' => 'PJOK',
        ],
        [
          'kelompok_mapel_id' => 3,
          'name' => 'Seni Tari',
          'singkatan' => 'TARI',
        ],
        [
          'kelompok_mapel_id' => 3,
          'name' => 'Seni Musik',
          'singkatan' => 'MUSIK',
        ],
        [
          'kelompok_mapel_id' => 3,
          'name' => 'Seni Teater',
          'singkatan' => 'TEATER',
        ],
        [
          'kelompok_mapel_id' => 3,
          'name' => 'Seni Lukis',
          'singkatan' => 'LUKIS',
        ],
        [
          'kelompok_mapel_id' => 4,
          'name' => 'Bahasa Jawa',
          'singkatan' => 'B.JAWA',
        ],
      ])->each(fn($q) => Mapel::create($q));
    }
}
