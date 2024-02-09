<?php

namespace Database\Seeders;

use App\Helpers\DummyHelper;
use App\Models\Sekolah;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
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
          'name' => 'SDN 1 INDONESIA',
          // 'jenjang' => 'SD',
          'nss' => '2423414',
          'npsn' => '24243243241234',
          'alamat' => DummyHelper::randAlamat(),
          'kodepos' => '43423',
          'telepon' => DummyHelper::randTelepon(),
          'email' => 'smpn1indonesia@gmail.com',
          'website' => 'google.com',
          'namakepsek' => 'Erik Santoso, S.Pd',
          'nipkepsek' => DummyHelper::randNip(),
        ],
      ])->each(fn($q) => Sekolah::create($q));
    }
}
