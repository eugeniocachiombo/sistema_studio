<?php

namespace Database\Factories\Utilizador;

use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\Pessoa;
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
        $id = $this->buscarIDUtilizador();
        $utilizador = User::find($id);
        $pessoa = Pessoa::where("user_id", $utilizador->id)->first();

        if ($pessoa) {
            return [];
        } else {
            if ($utilizador) {
                return [
                    "nome" => "Conta",
                    "sobrenome" => "Cantor",
                    "genero" => $this->faker->randomElement(["M", "F"]),
                    "nascimento" => rand(1990, 2002)."-". rand(1, 12) ."-". rand(1, 28),
                    "user_id" => $this->buscarIDUtilizador()
                ];
            } else {
                return [];
            }
        }
    }

    public function buscarIDUtilizador()
    {
        $user = \App\Models\User::select("users.*")
            ->leftJoin('pessoas', 'users.id', '=', 'pessoas.user_id')
            ->where("users.tipo_acesso", 3)
            ->where(function ($query) {
                $query->whereNull("pessoas.id");
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
