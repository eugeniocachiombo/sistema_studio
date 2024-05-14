<?php

namespace Database\Factories;

use App\Models\Acesso\Acesso;
use App\Models\User;
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
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(), 
            'password' => Hash::make('123'), 
            'telefone' => $this->buscarTelefoneAleatorio(), 
            'tipo_acesso' => 3,
            'remember_token' => Str::random(10),
        ];
    }

    public function buscarTelefoneAleatorio(){
        $telefone = "9".rand(11111111, 99999999);
        while (User::where("telefone", $telefone)->first()) {
            $telefone = "9".rand(12345678, 12345678);
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
