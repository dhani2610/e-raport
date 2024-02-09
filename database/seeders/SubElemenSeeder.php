<?php

namespace Database\Seeders;

use App\Models\SubElemen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubElemenSeeder extends Seeder
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
            'elemen_id' => 1,
            'name' => 'Mengenal dan Mencintai Tuhan Yang Maha Esa',
          ],
          [
            'elemen_id' => 1,
            'name' => 'Pemahaman Agama/ Kepercayaan',
          ],
          [
            'elemen_id' => 2,
            'name' => 'Integritas',
          ],
        ])->each(fn($q) => SubElemen::create($q));
    }
}
