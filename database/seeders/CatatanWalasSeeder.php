<?php

namespace Database\Seeders;

use App\Models\CatatanWalas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatatanWalasSeeder extends Seeder
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
          'siswa_id' => 1,
          'catatan' => 'Teruslah semangat dalam mencari ilmu!',
        ],
      ])->each(fn($q) => CatatanWalas::create($q));
    }
}
