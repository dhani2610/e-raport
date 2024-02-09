<?php

namespace Database\Factories;

use App\Models\Fase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projek>
 */
class ProjekFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fase_id' => Fase::inRandomOrder()->first()->id,
            // 'tema' => $this->faker->sentence(),
            'tema' => $this->faker->randomElement([
              'Gaya Hidup Berkelanjutan', 'Kearifan Lokal', 'Bhineka Tunggal Ika', 'Bangunlah Jiwa dan Raganya', 'Suara Demokrasi', 'Berekayasa dan Berteknologi untuk Membangun NKRI', 'Kewirausahan'
            ]),
            'name' => $this->faker->sentence(),
            'deskripsi' => $this->faker->paragraph(),
        ];
    }
}
