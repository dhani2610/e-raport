<?php

namespace Database\Seeders;

use App\Helpers\DummyHelper;
use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
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
          'user_id' => '2',
          'name' => 'Nama Wali Kelas',
          'nip' => DummyHelper::randNip(),
          // 'nuptk' => DummyHelper::randNuptk(),
          'jk' => DummyHelper::randJenisKelamin(),
          'tempatlahir' => DummyHelper::randKota(),
          'tanggallahir' => DummyHelper::randTanggalLahirGuru(),
          // 'telepon' => DummyHelper::randTelepon(),
          'alamat' => DummyHelper::randAlamat(),
        ],
        [
          'user_id' => '3',
          'name' => 'Nama Guru Mapel',
          // 'nip' => DummyHelper::randNip(),
          'nuptk' => DummyHelper::randNuptk(),
          'jk' => DummyHelper::randJenisKelamin(),
          'tempatlahir' => DummyHelper::randKota(),
          'tanggallahir' => DummyHelper::randTanggalLahirGuru(),
          'telepon' => DummyHelper::randTelepon(),
          // 'alamat' => DummyHelper::randAlamat(),
        ],
        [
          'user_id' => '4',
          'name' => 'nama Pembina Ekskul',
          // 'nip' => DummyHelper::randNip(),
          'nuptk' => DummyHelper::randNuptk(),
          'jk' => DummyHelper::randJenisKelamin(),
          // 'tempatlahir' => DummyHelper::randKota(),
          // 'tanggallahir' => DummyHelper::randTanggalLahirGuru(),
          'telepon' => DummyHelper::randTelepon(),
          'alamat' => DummyHelper::randAlamat(),
        ],
      ])->each(fn($q) => Guru::create($q));
    }
}
