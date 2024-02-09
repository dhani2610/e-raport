<?php

namespace Database\Seeders;

use App\Models\Tingkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TingkatSMPSeeder extends Seeder
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
          'angka' => '7',
          'romawi' => 'VII',
        ],
        [
          'fase_id' => 1,
          'angka' => '8',
          'romawi' => 'VIII',
        ],
        [
          'fase_id' => 1,
          'angka' => '9',
          'romawi' => 'IX',
        ],
      ])->each(fn($q) => Tingkat::create($q));
    }
}
