<?php

namespace Database\Factories\Utilizador;

use Illuminate\Database\Eloquent\Factories\Factory;

class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nome" => "Conta",
            "sobrenome" => "Cantor",
            "genero" => $this->faker->randomElement(["M", "F"]),
            "nascimento" => rand(1990, 2002) . "-" . rand(1, 12) . "-" . rand(1, 28),
        ];
    }

}
