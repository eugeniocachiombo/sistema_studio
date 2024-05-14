<?php

namespace Database\Factories\Participante;

use App\Models\Participante\Participante;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipanteFactory extends Factory
{
    public function definition()
    {
        $id = $this->buscarIDUtilizador();
        $utilizador = User::find($id);
        $participante = Participante::where("user_id", $utilizador->id)->first();

        if ($participante) {
            return [];
        } else {
            if ($utilizador) {
                return [
                    "nome" => $utilizador->name,
                    "user_id" => $utilizador->id,
                    "grupo_id" => null,
                ];
            } else {
                return [];
            }
        }
    }

    public function buscarIDUtilizador()
    {
        $user = \App\Models\User::select("users.*")
            ->leftJoin('participantes', 'users.id', '=', 'participantes.user_id')
            ->where("users.tipo_acesso", 3)
            ->where(function ($query) {
                $query->whereNull("participantes.id");
            })
            ->get();
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
