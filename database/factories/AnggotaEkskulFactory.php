<?php

namespace Database\Factories;

use App\Models\Ekskul;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnggotaEkskul>
 */
class AnggotaEkskulFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ekskul_id' => Ekskul::inRandomOrder()->first()->id,
            'siswa_id' => Siswa::inRandomOrder()->first()->id,
            'deskripsi' => $this->faker->randomElement([null,$this->faker->sentence()]),
            'predikat' => $this->faker->randomElement(['A','B','C','D',null]),
        ];
    }
}
