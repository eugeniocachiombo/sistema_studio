<?php

namespace App\Http\Livewire\Gravacao;

use App\Models\Grupo\Grupo;
use App\Models\Participante\Participante;
use App\Models\User;
use Livewire\Component;

class Agendar extends Component
{
    public $listaClientes = array();
    public $listaGrupos = array();
    public $listaParticipantes = array();
    public $nomeGrupo = null;
    public $nomeParticipante = null;

    protected $messages = [
        "nomeGrupo.required" => "Escreva o nome do grupo",
        "nomeParticipante.required" => "Escreva o nome do participante"
    ];

    /*protected $rules = [
        "nomeGrupo" => "required",
        "nomeParticipante" => "required"
    ];*/

    public function index()
    {
        return view('index.gravacao.agendar');
    }

    public function render()
    {
        $this->listaClientes = User::where("tipo_acesso", 3)->get();
        $this->listaGrupos = Grupo::all();
        $this->listaParticipantes = Participante::all();
        return view('livewire.gravacao.agendar');
    }

    public function criarGrupo(){
        $this->validate([
            "nomeGrupo" => "required"
        ]);
        Grupo::create(['nome' => $this->nomeGrupo]);
        $this->emit('alerta', ['mensagem' => 'Grupo criado com sucesso', 'icon' => 'success']);
        $this->nomeGrupo = null;
    }

    public function registarParticipantes(){
        $this->validate([
            "nomeParticipante" => "required"
        ]);
        Participante::create(['nome' => $this->nomeParticipante]);
        $this->emit('alerta', ['mensagem' => 'Grupo criado com sucesso', 'icon' => 'success']);
        $this->nomeGrupo = null;
    }

    public function agendarGravacao(){
        dd("Agendar Gravação");
    }
}
