<?php

namespace Database\Factories\Participante;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipanteFactory extends Factory
{
    public function definition()
    {
        $id = $this->faker->numberBetween(1, 20);
        $utilizador = User::find($id);

        return [
            "nome" => $utilizador->name, 
            "user_id" => $utilizador->id, 
            "grupo_id" => null
        ];
    }
}
