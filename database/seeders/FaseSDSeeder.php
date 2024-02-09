<?php

namespace Database\Seeders;

use App\Models\Fase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaseSDSeeder extends Seeder
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
          'name' => 'A',
          'keterangan' => 'Kelas 1-2',
        ],
        [
          'name' => 'B',
          'keterangan' => 'Kelas 3-4',
        ],
        [
          'name' => 'C',
          'keterangan' => 'Kelas 5-6',
        ],
      ])->each(fn($q) => Fase::create($q));
    }
}
