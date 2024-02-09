<?php

namespace Database\Seeders;

use App\Helpers\DummyHelper;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
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
          'user_id' => 5,
          'kelas_id' => 1,
          'name' => 'Elfan Siswa',
          'nis' => DummyHelper::randNis(),
          'nisn' => DummyHelper::randNisn(),
          'tempatlahir' => DummyHelper::randKota(),
          'tanggallahir' => DummyHelper::randTanggalLahirSiswa(),
          'jk' => DummyHelper::randJenisKelamin(),
          'agama' => 'islam',
          'statusdalamkeluarga' => 'AK',
          'anak_ke' => 2,
          'alamatsiswa' => DummyHelper::randAlamat(),
          'teleponsiswa' => DummyHelper::randTelepon(),
          'sekolahasal' => 'PAUD NURUL IHSAN',
          'diterimadikelas' => 'I',
          'diterimaditanggal' => '2023-07-18',
          'namaayah' => 'MUKHLIS',
          'pekerjaanayah' => 'POLRI',
          'namaibu' => 'DEDE',
          'pekerjaanibu' => 'BIDAN',
          'alamatortu' => DummyHelper::randAlamat(),
          'teleponortu' => DummyHelper::randTelepon(),
          // 'namawali' => 'abc',
          // 'pekerjaanwali' => 'abc',
          // 'alamatwali' => 'abc',
          // 'teleponwali' => 'abc',
        ],
      ])->each(fn($q) => Siswa::create($q));
    }
}
