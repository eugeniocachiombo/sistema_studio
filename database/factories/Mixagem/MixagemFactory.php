<?php

namespace Database\Factories\Mixagem;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MixagemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "gravacao_id" => $this->faker->numberBetween(3, 10),
            "data_mixagem" => Carbon::now(),
            "estado_mixagem" => $this->faker->randomElement(["pendente", "mixado"]),
            "duracao" => $this->faker->numberBetween(1, 10) . " hr",
            "responsavel" => $this->faker->numberBetween(1, 2),
            "updated_at" => Carbon::now()->year ."-". rand(1, 12) ."-". rand(1, 28). " 10:30",
        ];
    }
}
