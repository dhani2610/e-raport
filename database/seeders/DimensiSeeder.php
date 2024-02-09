<?php

namespace Database\Seeders;

use App\Models\Dimensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DimensiSeeder extends Seeder
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
          'name' => 'Beriman, Bertakwa Kepada Tuhan Yang Maha Esa, dan Berahlak Mulia',
        ],
        [
          'name' => 'Berkebhinekaan Global',
        ],
        [
          'name' => 'Bergotong Royong',
        ],
        [
          'name' => 'Mandiri',
        ],
        [
          'name' => 'Bernalar Kritis',
        ],
        [
          'name' => 'Kreatif',
        ],
      ])->each(fn($q) => Dimensi::create($q));
    }
}
