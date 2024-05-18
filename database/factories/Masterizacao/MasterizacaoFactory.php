<?php

namespace Database\Factories\Masterizacao;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Jenssegers\Agent\Agent;
use App\Models\Utilizador\RegistroActividade;

class MasterizacaoFactory extends Factory
{
    public $infoDispositivo;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->buscarDadosDispositivo();
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Fez um agendamento faker de masterização </b> <hr>" . $this->infoDispositivo, "normal", rand(1,2));
        
        return [
            "mixagem_id" => $this->buscarIDMixagem(),
            "data_master" => Carbon::now()->year ."-". rand(1, 12) ."-". rand(1, 28) . " ". rand(8, 18) . ":" . rand(0, 45),
            "estado_master" => $this->faker->randomElement(["pendente", "masterizado"]),
            "duracao" => $this->faker->numberBetween(1, 10) . " hr",
            "responsavel" => $this->faker->numberBetween(1, 2),
            "updated_at" => Carbon::now()->year ."-". rand(1, 12) ."-". rand(1, 28). rand(8, 18) . ":" . rand(0, 45)
        ];
    }

    public function buscarIDGravacao()
    {
        $gravacao = \App\Models\Gravacao\Gravacao::select("gravacaos.*")
        ->leftJoin('mixagems', 'gravacaos.id', '=', 'mixagems.gravacao_id')
        ->leftJoin('masterizacaos', 'mixagems.id', '=', 'masterizacaos.mixagem_id')
        ->where("gravacaos.estado_gravacao", "gravado")
        ->where("mixagems.estado_mixagem", "mixado")
        ->whereNull("masterizacaos.mixagem_id")
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

    public function buscarIDMixagem()
    {
        $gravacao_id = $this->buscarIDGravacao();
        $mixagem = \App\Models\Mixagem\Mixagem::where("gravacao_id", $gravacao_id)->get();
        $arrayIDsMixagens = array();
        foreach ($mixagem as $item) {
            array_push($arrayIDsMixagens, $item->id);
        }
        $qtdMixagens = count($mixagem);
        $indiceMixagem = $qtdMixagens > 0 ? rand(0, ($qtdMixagens - 1)) : 0;
        $mixagem_id = $arrayIDsMixagens[$indiceMixagem];
        return $mixagem_id;
    }

    public function registrarActividade($msg, $tipo, $user_id)
    {
        RegistroActividade::create([
            "mensagem" => $msg,
            "tipo_msg" => $tipo,
            "user_id" => $user_id,
        ]);
    }

    public function buscarDadosDispositivo()
    {
        $agente = new Agent();
        $dispositivo = $agente->device();
        $plataforma = $agente->platform();
        $versaoPlataforma = $agente->version($plataforma);
        $navegador = $agente->browser();
        $versaoNavegador = $agente->version($navegador);
        $this->infoDispositivo = "<b class='text-primary'>Dispositivo:</b> " . $agente->device() . " <br>" .
            "<b class='text-primary'>Plataforma:</b> " . $plataforma . " " . $versaoPlataforma . " <br>" .
            "<b class='text-primary'>Navegador:</b> " . $navegador . " " . $versaoNavegador . " ";
    }
}
