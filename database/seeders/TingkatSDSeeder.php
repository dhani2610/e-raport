<?php

namespace Database\Seeders;

use App\Models\Tingkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TingkatSDSeeder extends Seeder
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
          'angka' => '1',
          'romawi' => 'I',
        ],
        [
          'fase_id' => 1,
          'angka' => '2',
          'romawi' => 'II',
        ],
        [
          'fase_id' => 2,
          'angka' => '3',
          'romawi' => 'III',
        ],
        [
          'fase_id' => 2,
          'angka' => '4',
          'romawi' => 'IV',
        ],
        [
          'fase_id' => 3,
          'angka' => '5',
          'romawi' => 'V',
        ],
        [
          'fase_id' => 3,
          'angka' => '6',
          'romawi' => 'VI',
        ],
      ])->each(fn($q) => Tingkat::create($q));
    }
}
