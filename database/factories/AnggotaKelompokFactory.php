<?php

namespace Database\Factories;

use App\Models\KelompokProjek;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnggotaKelompok>
 */
class AnggotaKelompokFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $kelompokProjek = KelompokProjek::inRandomOrder()->first();
        return [
          'kelompok_projek_id' => $kelompokProjek->id,
          'siswa_id' => Siswa::where('kelas_id', $kelompokProjek->kelas_id)->inRandomOrder()->first()->id,
        ];
    }
}
