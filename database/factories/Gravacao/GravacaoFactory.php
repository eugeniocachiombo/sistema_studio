<?php

namespace Database\Factories\Gravacao;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GravacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "cliente_id" => $this->faker->numberBetween(3, 10),
            "grupo_id" => null,
            "titulo_audio" => $this->faker->word,
            "estilo_audio" => $this->faker->numberBetween(1, 3),
            "data_gravacao" => Carbon::now(),
            "estado_gravacao" => $this->faker->randomElement(["pendente", "gravado"]),
            "duracao" => $this->faker->numberBetween(1, 10) . "hr",
            "responsavel" => $this->faker->numberBetween(1, 2)
        ];
    }
}
