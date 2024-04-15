<?php

namespace Database\Factories\chat;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ConversaFactory extends Factory
{
    
    public function definition()
    {
        $emissor = $this->faker->numberBetween(1, 10);
        $receptor = $this->faker->numberBetween(1, 10);
        
        while ($receptor === $emissor) {
            $receptor = $this->faker->numberBetween(1, 10);
        }
        
        return [
            "emissor" => $emissor,
            "receptor" => $receptor,
            "estado" => "Pendente",
            "mensagem" => Crypt::encrypt($this->faker->text)
        ];
    }
}
