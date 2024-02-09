<?php

namespace Database\Seeders;

use App\Models\KelompokMapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelompokMapelSeeder extends Seeder
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
          'huruf' => 'A',
          'name' => 'Mata Pelajaran Wajib',
        ],
        [
          'huruf' => 'B',
          'name' => 'Mata Pelajaran Pilihan',
        ],
        [
          'huruf' => 'C',
          'name' => 'Seni dan Budaya',
        ],
        [
          'huruf' => 'D',
          'name' => 'Muatan Lokal',
        ],
      ])->each(fn($q) => KelompokMapel::create($q));
    }
}
