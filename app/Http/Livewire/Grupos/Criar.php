<?php

namespace App\Http\Livewire\Grupos;

use App\Models\Estilo\Estilo;
use App\Models\Grupo\Grupo;
use App\Models\Grupo\GrupoCliente;
use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Criar extends Component
{
    public $participantesEscolhidos = array();
    public $nomeGrupo;
    public $tbMembrosGrupo;
    public $infoDispositivo;
    public $listaMembrosClientes = array();
    public $termoPesquisaMembros;
    public $clientesEscolhidos = array();
    public $estilo_id;
    public $listaEstilos;

    protected $messages = [
        "cliente_id.required" => "Campo obrigatório",
        "grupoEscolhido.required" => "Campo obrigatório",
        "tituloAudio.required" => "Campo obrigatório",
        "estilo_id.required" => "Campo obrigatório",

        "dataGravacao.required" => "Campo obrigatório",
        "dataGravacao.regex" => "Só é possível agendar das 08:00 até 18:00",

        "duracaoGravacao.required" => "Campo obrigatório",
        "nomeGrupo.required" => "Escreva o nome do grupo",
        "nomeParticipante.required" => "Escreva o nome do participante",
    ];

    public function mount()
    {
        $this->buscarDadosDispositivo();
        $this->participantesEscolhidos = [];
    }

    public function index()
    {
        return view('index.grupos.criar');
    }
    
    public function render()
    {
        $this->listaEstilos = Estilo::all();
        $this->listaMembrosClientes = $this->buscarListaParaMembrosParaGrupo();
        return view('livewire.grupos.criar');
    }
    
    public function adicionarMembrosAoGrupo()
    {
        $grupo_id =session("grupo_id");
        session()->forget("grupo_id");
        foreach ($this->clientesEscolhidos as $item) {
            GrupoCliente::create([
                "grupo_id" => $grupo_id,
                "membro" => $item,
            ]);
        }
        $this->emit('alerta', ['mensagem' => 'Membros adicionados com sucesso', 'icon' => 'success', 'tempo' => 5000]);
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Adicionou membros ao grupo ". Grupo::find($grupo_id)->nome ." </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        $this->clientesEscolhidos = array();
        $this->tbMembrosGrupo = false;
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

    public function criarGrupo()
    {
        $this->validate([
            "nomeGrupo" => "required",
            "estilo_id" => "required"
        ]);

        $grupo = Grupo::where('nome', $this->nomeGrupo)->first();
        if ($grupo) {
            $this->emit('alerta', ['mensagem' => 'Este grupo já existe', 'icon' => 'warning', 'tempo' => 4500]);
            $this->nomeGrupo = null;
        } else {
            $grupo = Grupo::create([
                'nome' => $this->nomeGrupo,
                'estilo_grupo' => $this->estilo_id,
                'responsavel' => Auth::user()->id,
            ]);
            Participante::create([
                'nome' => $grupo->nome . " (Grupo)",
                'grupo_id' => $grupo->id,
            ]);
            session()->put("grupo_id", $grupo->id);
            $this->emit('alerta', ['mensagem' => 'Grupo criado com sucesso', 'icon' => 'success']);
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Adicionou o grupo ". Grupo::find($grupo->id)->nome ." fazedores do estilo " . Estilo::find($this->estilo_id)->tipo ." ao sistema </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
            $this->tbMembrosGrupo = true;
            $this->nomeGrupo = null;
            $this->listaEstilos = "";
        }
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

    public function eliminarUtilizador($id){
        User::find($id)->delete();
        $this->emit('alerta', ['mensagem' => 'Utilizador eliminado do sistema', 'icon' => 'success', 'tempo' => 5000]);
        $this->emit('atrazar_redirect', ['caminho' => '/utilizador/listagem/todos', 'tempo' => 2500]);
    }

    public function limparCampos()
    {
        $this->tbMembrosGrupo = false;
        $this->nomeGrupo = null;
        $this->participantesEscolhidos = array();
    }
}
