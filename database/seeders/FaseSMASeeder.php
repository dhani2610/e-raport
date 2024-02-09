<?php

namespace Database\Seeders;

use App\Models\Fase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaseSMASeeder extends Seeder
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
          'name' => 'E',
          'keterangan' => 'Kelas 10-12',
        ],
      ])->each(fn($q) => Fase::create($q));
    }
}
