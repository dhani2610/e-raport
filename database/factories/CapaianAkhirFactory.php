<?php

namespace Database\Factories;

use App\Models\Fase;
use App\Models\SubElemen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CapaianAkhir>
 */
class CapaianAkhirFactory extends Factory
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
          'sub_elemen_id' => SubElemen::inRandomOrder()->first()->id,
          'name' => $this->faker->sentence,
        ];
    }
}
