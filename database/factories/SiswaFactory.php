<?php

namespace Database\Factories;

use App\Helpers\DummyHelper;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create();
        $kelas = Kelas::inRandomOrder()->first();
        return [
          'user_id' => $user->id,
          'kelas_id' => $this->faker->randomElement([$kelas->id]),
          'name' => $this->faker->name,
          'nis' => DummyHelper::randNis(),
          'nisn' => DummyHelper::randNisn(),
          'tempatlahir' => DummyHelper::randKota(),
          'tanggallahir' => DummyHelper::randTanggalLahirSiswa(),
          'jk' => DummyHelper::randJenisKelamin(),
          'agama' => $this->faker->randomElement(['Islam', 'Kristen']),
          'statusdalamkeluarga' => $this->faker->randomElement(['AK', 'AA', 'AT']),
          'anak_ke' => $this->faker->randomElement(['1','2','3','4','5']),
          'alamatsiswa' => $this->faker->address,
          'teleponsiswa' => DummyHelper::randTelepon(),
          'sekolahasal' => $this->faker->randomElement(['PAUD AL-IHSAN', 'RA MAMBAUS', null]),
          'diterimadikelas' => 'I',
          'diterimaditanggal' => $this->faker->randomElement(['2023-07-18','2022-07-20','2021-07-16',]),
          'namaayah' => $this->faker->randomElement([null, $this->faker->firstNameMale()]),
          'pekerjaanayah' => $this->faker->randomElement([null, $this->faker->jobTitle()]),
          'namaibu' => $this->faker->randomElement([null, $this->faker->firstNameFemale()]),
          'pekerjaanibu' => $this->faker->randomElement([null, $this->faker->jobTitle()]),
          'alamatortu' => $this->faker->randomElement([null, $this->faker->address()]),
          'teleponortu' => $this->faker->randomElement([null, DummyHelper::randTelepon()]),
          'namawali' => $this->faker->randomElement([null, $this->faker->name]),
          'pekerjaanwali' => $this->faker->randomElement([null, $this->faker->jobTitle()]),
          'alamatwali' => $this->faker->randomElement([null, $this->faker->address]),
          'teleponwali' => $this->faker->randomElement([null, DummyHelper::randTelepon()]),
        ];
    }
}
