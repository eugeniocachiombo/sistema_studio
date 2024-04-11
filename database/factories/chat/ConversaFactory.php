<?php

namespace Database\Factories\chat;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConversaFactory extends Factory
{
    
    public function definition()
    {
        return [
            "emissor" => 1,
            "receptor" => 2,
            "estado" => "Pendente",
            "mensagem" => $this->faker->text,
            "caminho_arquivo" => "",
            "tipo_arquivo" =>  ""
        ];
    }
}
