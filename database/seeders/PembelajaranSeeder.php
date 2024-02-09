<?php

namespace Database\Seeders;

use App\Models\Pembelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembelajaranSeeder extends Seeder
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
          'kelas_id' => 1,
          'mapel_id' => 1,
          'guru_id' => 2,
        ],
      ])->each(fn($q) => Pembelajaran::create($q));
    }
}
