<?php

namespace Database\Factories\chat;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ConversaFactory extends Factory
{
    
    public function definition()
    {
        $emissor = $this->buscarIDEmissor();
        $receptor = $this->buscarIDReceptor();
        
        while ($receptor === $emissor) {
            $receptor = $this->buscarIDReceptor();
        }
        
        return [
            "emissor" => $emissor,
            "receptor" => $receptor,
            "estado" => "Pendente",
            "mensagem" => Crypt::encrypt($this->faker->text)
        ];
    }

    public function buscarIDEmissor()
    {
        $user = \App\Models\User::all();
        $arrayIDsUsers = array();
        foreach ($user as $item) {
            array_push($arrayIDsUsers, $item->id);
        }
        $qtdUsers = count($user);
        $indiceUser = $qtdUsers > 0 ? rand(0, ($qtdUsers - 1)) : 0;
        $user_id = $arrayIDsUsers[$indiceUser];
        return $user_id;
    }

    public function buscarIDReceptor()
    {
        $user = \App\Models\User::all();
        $arrayIDsUsers = array();
        foreach ($user as $item) {
            array_push($arrayIDsUsers, $item->id);
        }
        $qtdUsers = count($user);
        $indiceUser = $qtdUsers > 0 ? rand(0, ($qtdUsers - 1)) : 0;
        $user_id = $arrayIDsUsers[$indiceUser];
        return $user_id;
    }
}
