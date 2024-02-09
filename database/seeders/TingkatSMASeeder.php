<?php

namespace Database\Seeders;

use App\Models\Tingkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TingkatSMASeeder extends Seeder
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
          'fase_id' => 1,
          'angka' => '10',
          'romawi' => 'X',
        ],
        [
          'fase_id' => 1,
          'angka' => '11',
          'romawi' => 'XI',
        ],
        [
          'fase_id' => 1,
          'angka' => '12',
          'romawi' => 'XII',
        ],
      ])->each(fn($q) => Tingkat::create($q));
    }
}
