<?php

namespace Database\Seeders;

use App\Helpers\DummyHelper;
use App\Models\Tapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TapelSeeder extends Seeder
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
          'tahun_pelajaran' => '2023/2024',
          'semester' => '1',
          'tanggal' => '2023-12-23',
          'tempat' => DummyHelper::randKota(),
        ],
      ])->each(fn($q) => Tapel::create($q));
    }
}
