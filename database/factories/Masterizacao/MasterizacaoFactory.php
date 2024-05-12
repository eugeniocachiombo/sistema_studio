<?php

namespace Database\Factories\Masterizacao;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterizacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "mixagem_id" => $this->faker->numberBetween(3, 10),
            "data_master" => Carbon::now(),
            "estado_master" => $this->faker->randomElement(["pendente", "masterizado"]),
            "duracao" => $this->faker->numberBetween(1, 10) . " hr",
            "responsavel" => $this->faker->numberBetween(1, 2),
            "updated_at" => Carbon::now()->year ."-". rand(1, 12) ."-". rand(1, 28). " 10:30",
        ];
    }
}
