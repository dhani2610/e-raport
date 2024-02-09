<?php

namespace Database\Factories;

use App\Helpers\DummyHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      $user = User::factory()->create();
      return [
          'user_id' => $user->id,
          'name' => $this->faker->randomElement([$this->faker->name()]),
          'nip' => $this->faker->randomElement([DummyHelper::randNip(),null]),
          'nuptk' => $this->faker->randomElement([DummyHelper::randNuptk(),null]),
          'jk' => $this->faker->randomElement(['L','P']),
          'tempatlahir' => $this->faker->randomElement([$this->faker->city(),null]),
          'tanggallahir' => $this->faker->randomElement([DummyHelper::randTanggalLahirGuru(),null]),
          'telepon' => $this->faker->randomElement([DummyHelper::randTelepon(),null]),
          'alamat' => $this->faker->randomElement([$this->faker->address(),null]),
      ];
    }
}
