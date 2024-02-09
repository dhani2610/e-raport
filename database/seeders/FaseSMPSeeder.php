<?php

namespace Database\Seeders;

use App\Models\Fase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaseSMPSeeder extends Seeder
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
          'name' => 'D',
          'keterangan' => 'Kelas 7-9',
        ],
      ])->each(fn($q) => Fase::create($q));
    }
}
