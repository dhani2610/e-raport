<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KelompokProjek>
 */
class KelompokProjekFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'kelas_id' => Kelas::inRandomOrder()->first()->id,
          'guru_id' => Guru::inRandomOrder()->first()->id,
          'name' => $this->faker->sentence,
        ];
    }
}
