<?php

namespace Database\Factories;

use App\Models\CapaianAkhir;
use App\Models\Projek;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CapaianProjek>
 */
class CapaianProjekFactory extends Factory
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
            'capaian_akhir_id' => CapaianAkhir::where('fase_id', $projek->fase_id)->inRandomOrder()->first()->id,
        ];
    }
}
