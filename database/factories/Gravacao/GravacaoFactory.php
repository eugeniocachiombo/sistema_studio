<?php

namespace Database\Factories\Gravacao;

use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\Pessoa;
use App\Models\Utilizador\RegistroActividade;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Jenssegers\Agent\Agent;

class GravacaoFactory extends Factory
{
    public $infoDispositivo;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->pessoasParticipantes();
        $this->buscarDadosDispositivo();
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Fez um agendamento faker de gravação </b> <hr>" . $this->infoDispositivo, "normal", rand(1,2));
        return [
            "cliente_id" => $this->faker->numberBetween(3, 10),
            "grupo_id" => null,
            "titulo_audio" => $this->faker->word,
            "estilo_audio" => $this->faker->numberBetween(1, 3),
            "data_gravacao" => Carbon::now()->year ."-". rand(1, 12) ."-". rand(1, 28) . " ". rand(8, 18) . ":" . rand(0, 45),
            "estado_gravacao" => $this->faker->randomElement(["pendente", "gravado"]),
            "duracao" => $this->faker->numberBetween(1, 10) . " hr",
            "responsavel" => $this->faker->numberBetween(1, 2),
            "updated_at" => Carbon::now()->year ."-". rand(1, 12) ."-". rand(1, 28). " 10:30"
        ];
    }

    public function pessoasParticipantes(){
        $utilizador = User::all();
        foreach ($utilizador as $item) {
            if(!Pessoa::where("user_id", $item->id)->first()){
                Pessoa::create([
                    "nome" => $this->faker->word,
                    "sobrenome" => $this->faker->word,
                    "genero" => 'M',
                    "nascimento" => rand(1990, 2002)."-". rand(1, 12) ."-". rand(1, 28),
                    "user_id" => $item->id
                ]);
            }
            if(!Participante::where("user_id", $item->id)->first()){
                Participante::create([
                    "nome" => $item->name,
                    "user_id" => $item->id,
                    "grupo_id" => null,
                ]);
            }
        }
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
