<?php

namespace Database\Factories\chat;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ConversaFactory extends Factory
{
    
    public function definition()
    {
        return [
            "emissor" => 1,
            "receptor" => 2,
            "estado" => "Pendente",
            "mensagem" => Crypt::encrypt($this->faker->text),
            "caminho_arquivo" => "",
            "tipo_arquivo" =>  ""
        ];
    }
}
