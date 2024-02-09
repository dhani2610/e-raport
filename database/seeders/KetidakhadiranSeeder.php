<?php

namespace Database\Seeders;

use App\Models\Ketidakhadiran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KetidakhadiranSeeder extends Seeder
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
          'siswa_id' => 1,
          'sakit' => '2',
          'izin' => null,
          'tk' => null,
        ],
      ])->each(fn($q) => Ketidakhadiran::create($q));
    }
}
