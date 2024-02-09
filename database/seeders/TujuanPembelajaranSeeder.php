<?php

namespace Database\Seeders;

use App\Models\TujuanPembelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TujuanPembelajaranSeeder extends Seeder
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
          'pembelajaran_id' => 1,
          'keterangan' => 'Memahami konsep Tawhid (Keesaan Allah)'
        ],
        [
          'pembelajaran_id' => 1,
          'keterangan' => 'Belajar tentang nabi dan rasul dalam Islam'
        ],
        [
          'pembelajaran_id' => 1,
          'keterangan' => 'Memahami pentingnya salat (shalat) dalam kehidupan'
        ],
        [
          'pembelajaran_id' => 1,
          'keterangan' => 'Mengenal nilai-nilai moral dan etika dalam Islam'
        ],
        [
          'pembelajaran_id' => 1,
          'keterangan' => 'Mengetahui kisah-kisah dalam Al-Quran sebagai pelajaran moral'
        ],
      ])->each(fn($q) => TujuanPembelajaran::create($q));
    }
}
