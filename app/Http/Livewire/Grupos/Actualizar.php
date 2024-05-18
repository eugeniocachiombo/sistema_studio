<?php

namespace App\Http\Livewire\Grupos;

use App\Models\Gravacao\Estilo as GravacaoEstilo;
use App\Models\Grupo\Estilo;
use App\Models\Grupo\Grupo;
use App\Models\Grupo\GrupoCliente;
use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Actualizar extends Component
{
    public $membrosEscolhidos = array();
    public $nomeGrupo;
    public $tbMembrosGrupo;
    public $infoDispositivo;
    public $listaMembrosClientes = array();
    public $termoPesquisaMembros;
    public $clientesEscolhidos = array();
    public $grupo_id;
    public $estilo_id;
    public $listaEstilos;
    public $dadosActualGrupo;

    protected $messages = [
        "cliente_id.required" => "Campo obrigatório",
        "grupoEscolhido.required" => "Campo obrigatório",
        "tituloAudio.required" => "Campo obrigatório",
        "estilo_id.required" => "Campo obrigatório",

        "dataGrupo.required" => "Campo obrigatório",
        "dataGrupo.regex" => "Só é possível agendar das 08:00 até 18:00",

        "duracaoGrupo.required" => "Campo obrigatório",
        "nomeGrupo.required" => "Escreva o nome do grupo",
        "nomeParticipante.required" => "Escreva o nome do participante",
    ];

    public function mount($id)
    {
        $this->grupo_id = $id;
        $this->buscarDadosDispositivo();
        $this->membrosEscolhidos = array();
        $this->setarInicialmenteDadosGrupo();
    }

    public function index($id)
    {
        return view('index.grupos.actualizar', ["id"=>$id]);
    }
    
    public function render()
    {
        $this->listaEstilos = GravacaoEstilo::all();
        $this->listaMembrosClientes = $this->buscarListaParaMembrosParaGrupo();
        return view('livewire.grupos.actualizar');
    }

    public function setarInicialmenteDadosGrupo(){
        $this->dadosActualGrupo = Grupo::where("id", $this->grupo_id)->first();
        $this->nomeGrupo = $this->dadosActualGrupo->nome;
        $this->estilo_id = $this->dadosActualGrupo->estilo_grupo;
        $todosMembros = GrupoCliente::where("grupo_id", $this->grupo_id)->get();

        foreach ($todosMembros as $item) {
            $this->clientesEscolhidos[$item->membro] = $item->membro;
        } 
    }
    
    public function buscarListaParaMembrosParaGrupo()
    {
        return User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->termoPesquisaMembros . '%')
                ->orWhere('id', 'like', '%' . $this->termoPesquisaMembros . '%');
        })
            ->where("tipo_acesso", 3)
            ->orderBy("id", "desc")
            ->limit(5)
            ->get();
    }

    public function actualizarGrupo()
    {
        $this->validate([
            "nomeGrupo" => "required",
            "estilo_id" => "required"
        ]);

        $grupo = Grupo::where("id", $this->grupo_id)->update([
            'nome' => $this->nomeGrupo,
            'estilo_grupo' => $this->estilo_id,
            'responsavel' => Auth::user()->id,
        ]);
        $this->adicionarMembrosAoGrupo();
        $this->emit('alerta', ['mensagem' => 'Grupo actualizado com sucesso', 'icon' => 'success']);
        $this->emit('atrazar_redirect', ['caminho' => '/grupo/listar', 'tempo' => 2500]);
        $this->tbMembrosGrupo = true;
        $this->nomeGrupo = null;
    }

    public function adicionarMembrosAoGrupo()
    {
        foreach ($this->clientesEscolhidos as $item) {
            GrupoCliente::create([
                "grupo_id" => $this->grupo_id,
                "membro" => $item,
            ]);
        }
        $this->clientesEscolhidos = array();
        $this->tbMembrosGrupo = false;
    }


    public function buscarGrupoCliente($cliente_id)
    {
        return GrupoCliente::where("membro", $cliente_id)->first();
    }

    public function buscarGrupo($id)
    {
        return Grupo::find($id);
    }

    public function buscarNomeCliente($id)
    {
        $dadosPartic = User::find($id);
        return $dadosPartic ? $dadosPartic->name . ", " : "";
    }

    public function buscarFotoPerfil($idUtilizador)
    {
        $foto = FotoPerfil::where("user_id", $idUtilizador)->orderby("id", "desc")->first();
        if ($foto) {
            $caminho = public_path('assets/' . $foto->caminho_arquivo);
            if (file_exists($caminho)) {
                return $foto;
            } else {
                return null;
            }
        } else {
            return null;
        }
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

    public function eliminarUtilizador($id){
        User::find($id)->delete();
        $this->emit('alerta', ['mensagem' => 'Utilizador eliminado do sistema', 'icon' => 'success', 'tempo' => 5000]);
        $this->emit('atrazar_redirect', ['caminho' => '/utilizador/listagem/todos', 'tempo' => 2500]);
    }

    public function limparCampos()
    {
        $this->tbMembrosGrupo = false;
        $this->nomeGrupo = null;
        $this->membrosEscolhidos = array();
    }
}