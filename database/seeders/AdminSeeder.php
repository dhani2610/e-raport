<?php

namespace Database\Seeders;

use App\Helpers\DummyHelper;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
          'user_id' => '1',
          'name' => 'Admin',
          'nip' => DummyHelper::randNip(),
          'nuptk' => DummyHelper::randNuptk(),
          'jk' => DummyHelper::randJenisKelamin(),
          'tempatlahir' => DummyHelper::randKota(),
          'tanggallahir' => DummyHelper::randTanggalLahirGuru(),
          'telepon' => DummyHelper::randTelepon(),
          'alamat' => DummyHelper::randAlamat(),
        ],
      ])->each(fn($q) => Admin::create($q));
    }
}
