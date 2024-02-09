<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
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
          'tingkat_id' => 1,
          'tapel_id' => 1,
          'guru_id' => 1,
          'name' => 'Kelas 1',
        ],
        [
          'tingkat_id' => 2,
          'tapel_id' => 1,
          'guru_id' => null,
          'name' => 'Kelas 2',
        ],
        [
          'tingkat_id' => 3,
          'tapel_id' => 1,
          'guru_id' => null,
          'name' => 'Kelas 3',
        ],
        [
          'tingkat_id' => 4,
          'tapel_id' => 1,
          'guru_id' => null,
          'name' => 'Kelas 4',
        ],
        [
          'tingkat_id' => 5,
          'tapel_id' => 1,
          'guru_id' => null,
          'name' => 'Kelas 5',
        ],
        [
          'tingkat_id' => 6,
          'tapel_id' => 1,
          'guru_id' => null,
          'name' => 'Kelas 6',
        ],
      ])->each(fn($q) => Kelas::create($q));
    }
}
