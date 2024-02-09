<?php

namespace Database\Factories;

use App\Models\Elemen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubElemen>
 */
class SubElemenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'elemen_id' => Elemen::inRandomOrder()->first()->id,
          'name' => $this->faker->sentence,
        ];
    }
}
