<?php

namespace Database\Factories\Mixagem;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MixagemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "gravacao_id" => $this->buscarIDGravacao(),
            "data_mixagem" => Carbon::now()->year . "-" . rand(1, 12) . "-" . rand(1, 28) . " 10:30",
            "estado_mixagem" => $this->faker->randomElement(["pendente", "mixado"]),
            "duracao" => $this->faker->numberBetween(1, 10) . " hr",
            "responsavel" => $this->faker->numberBetween(1, 2),
            "updated_at" => Carbon::now()->year . "-" . rand(1, 12) . "-" . rand(1, 28) . " 10:30",
        ];
    }

    public function buscarIDGravacao()
    {
        $gravacao = \App\Models\Gravacao\Gravacao::select("gravacaos.*")
        ->leftJoin('mixagems', 'gravacaos.id', '=', 'mixagems.gravacao_id')
        ->where("gravacaos.estado_gravacao", "gravado")
        ->where(function ($query) {
            $query->whereNull("mixagems.id");
        })
        ->get();
        $arrayIDsGravacoes = array();
        foreach ($gravacao as $item) {
            array_push($arrayIDsGravacoes, $item->id);
        }
        $qtdGravacoes = count($gravacao);
        $indiceGravacao = $qtdGravacoes > 0 ? rand(0, ($qtdGravacoes - 1)) : 0;
        $gravacao_id = $arrayIDsGravacoes[$indiceGravacao];
        return $gravacao_id;
    }
}
