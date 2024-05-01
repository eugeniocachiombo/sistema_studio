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
    public $cliente_id = null, $grupoEscolhido = null, $tituloAudio = null, $estilo_id = null, $dataGravacao = null, $duracaoGravacao = null,
    $participantesEscolhidos = array();
    protected $participantesFiltrados = array();
    public $termoPesquisa = '';

    protected $messages = [
        "cliente_id.required" => "Campo obrigatório",
        "grupoEscolhido.required" => "Campo obrigatório",
        "tituloAudio.required" => "Campo obrigatório",
        "estilo_id.required" => "Campo obrigatório",
        "dataGravacao.required" => "Campo obrigatório",
        "duracaoGravacao.required" => "Campo obrigatório",
        "nomeGrupo.required" => "Escreva o nome do grupo",
        "nomeParticipante.required" => "Escreva o nome do participante",
    ];

    public function index()
    {
        return view('index.gravacao.agendar');
    }

    public function mount()
    {
        $this->participantesEscolhidos = [];
    }

    public function render()
    {
        $participantes = Participante::where('nome', 'like', '%' . $this->termoPesquisa . '%')->paginate(7);
        $this->listaClientes = User::where("tipo_acesso", 3)->get();
        $this->listaGrupos = Grupo::all();
        $this->listaParticipantes = Participante::all();
        return view('livewire.gravacao.agendar', ["participantesFiltrados" => $participantes]);
    }

    public function criarGrupo()
    {
        $this->validate([
            "nomeGrupo" => "required",
        ]);
        Grupo::create(['nome' => $this->nomeGrupo]);
        $this->emit('alerta', ['mensagem' => 'Grupo criado com sucesso', 'icon' => 'success']);
        $this->nomeGrupo = null;
    }

    public function registarParticipantes()
    {
        $this->validate([
            "nomeParticipante" => "required",
        ]);
        Participante::create(['nome' => $this->nomeParticipante]);
        $this->emit('alerta', ['mensagem' => 'Grupo criado com sucesso', 'icon' => 'success']);
        $this->nomeParticipante = null;
    }

    public function escolherParticipantes($id)
    {
        $dadosPartic = Participante::find($id);

        $index = array_search($id, array_column($this->participantesEscolhidos, 'id'));

        if ($index === false) {
            $this->participantesEscolhidos[] = [
                "id" => $dadosPartic->id,
                "nome" => $dadosPartic->nome,
                "created_at" => $dadosPartic->created_at,
                "updated_at" => $dadosPartic->updated_at,
            ];
        } else {
            unset($this->participantesEscolhidos[$index]);
        }
    }

    public function buscarNomeParticipante($id)
    {
        $dadosPartic = Participante::find($id);
        return $dadosPartic ? $dadosPartic->nome : "";
    }

    public function agendarGravacao()
    {
        $this->validate([
            "cliente_id" => "required",
            "grupoEscolhido" => "required",
            "tituloAudio" => "required",
            "estilo_id" => "required",
            "dataGravacao" => "required",
            "duracaoGravacao" => "required",
        ]);
        dd("Agendar Gravação");
    }
}
