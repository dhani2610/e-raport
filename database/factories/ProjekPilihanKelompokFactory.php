<?php

namespace Database\Factories;

use App\Models\KelompokProjek;
use App\Models\Projek;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjekPilihanKelompok>
 */
class ProjekPilihanKelompokFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $projek = Projek::inRandomOrder()->first();
        return [
          'projek_id' => $projek->id,
          'kelompok_projek_id' => KelompokProjek::inRandomOrder()->first()->id,
        ];
    }
}
