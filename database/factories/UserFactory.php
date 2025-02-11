<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Utilizador\Pessoa;
use App\Models\Utilizador\RedesSociais;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pessoa = Pessoa::create([
            "nome" => "Conta",
            "sobrenome" => "Cantor",
            "genero" => $this->faker->randomElement(["M", "F"]),
            "nascimento" => rand(1990, 2002) . "-" . rand(1, 12) . "-" . rand(1, 28),
        ]);

        return [
            "pessoa_id" => $pessoa->id,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'telefone' => $this->buscarTelefoneAleatorio(),
            'tipo_acesso' => 3,
            'remember_token' => Str::random(10),
        ];
    }

    public function buscarTelefoneAleatorio()
    {
        $telefone = "9" . rand(1, 5) . rand(1111111, 9999999);
        while (User::where("telefone", $telefone)->first()) {
            $telefone = "9" . rand(1, 5) . rand(1111111, 9999999);
        }
        return $telefone;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
