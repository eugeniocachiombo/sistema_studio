<?php

namespace App\Http\Livewire\Gravacao;

use App\Models\Aprovacao\ClientesAprovado;
use App\Models\Estilo\Estilo;
use App\Models\Gravacao\Gravacao;
use App\Models\Gravacao\GravacaoParticipante;
use App\Models\Grupo\Grupo;
use App\Models\Grupo\GrupoCliente;
use App\Models\Masterizacao\Masterizacao;
use App\Models\Mixagem\Mixagem;
use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use App\Models\Utilizador\RegistroActividade;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;
use PhpParser\Node\PropertyItem;

class Actualizar extends Component
{
    public $idGravacao = null;
    public $listaClientes = array();
    public $listaGrupos = array();
    public $listaParticipantes = array();
    public $nomeGrupo = null, $nomeParticipante = null, $dataMin;

    public $cliente_id = null, $grupoEscolhido = null, $tituloAudio = null, $estilo_id = null,
    $dataGravacao = null, $duracaoGravacao = null, $participantesEscolhidos = array(),
    $clientesEscolhidos = array(), $listaMembrosClientes = array();

    protected $participantesFiltrados = array();
    public $termoPesquisa = '', $termoPesquisaMembros = '';
    public $listaEstilos = array();
    public $infoDispositivo = null, $tbMembrosGrupo = false;
    public $dadosActualGravacao = array();

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

    public function mount($idGravacao)
    {
        $this->idGravacao = $idGravacao;
        $this->buscarDadosDispositivo();
        $this->participantesEscolhidos = array();
        $this->setarInicialmenteDadosGravacao();
    }

    public function render()
    {
        $this->dataMinimaAgendamento();
        $this->listaEstilos = Estilo::all();
        $participantes = $this->buscarTodosParticipantes();
        $this->listaMembrosClientes = $this->buscarListaParaMembrosParaGrupo();
        $this->listaClientes = ClientesAprovado::all();
        $this->listaGrupos = Grupo::all();
        $this->removerGrupoParticipanteJaSelecionado($this->grupoEscolhido);
        $this->removerClienteParticipanteJaSelecionado($this->cliente_id);
        return view('livewire.gravacao.actualizar', [
            "participantesFiltrados" => $participantes
            ])
        ->layout("layouts.logado.app");
    }

    public function dataMinimaAgendamento()
    {
        $maiorEntidade = array();
        $gravacao = Gravacao::max("data_gravacao");
        $mixagem = Mixagem::max("data_mixagem");
        $masterizacao = Masterizacao::max("data_master");
        $maiorData = max($gravacao, $mixagem, $masterizacao);

        if (!empty($maiorData)) {
            if ($maiorData == $gravacao) {
                $maiorEntidade = Gravacao::where("data_gravacao", $maiorData)->first();
            } else if ($maiorData == $mixagem) {
                $maiorEntidade = Mixagem::where("data_mixagem", $maiorData)->first();
            } else if ($maiorData == $masterizacao) {
                $maiorEntidade = Masterizacao::where("data_master", $maiorData)->first();
            }

            $duracao = (int) trim($maiorEntidade->duracao, " hr");
            $maiorHora = (int) date('H', strtotime($maiorData));
            $horaAgenda = $maiorHora + $duracao;
            $dataAgenda = date('Y-m-d', strtotime($maiorData)) . " " . ($horaAgenda + 1) . ":00";
            $this->dataMin = date('Y-m-d\TH:i', strtotime($dataAgenda));
        } else {
            $dataAgenda = Carbon::now();
            $this->dataMin = date('Y-m-d\TH:i', strtotime($dataAgenda));
        }
    }

    public function setarInicialmenteDadosGravacao(){
        $this->dadosActualGravacao = Gravacao::where("id", $this->idGravacao)->first();
        $this->cliente_id = $this->dadosActualGravacao->cliente_id != null ? $this->dadosActualGravacao->cliente_id : null;
        $this->grupoEscolhido = $this->dadosActualGravacao->grupo_id != null ? $this->dadosActualGravacao->grupo_id : null;
        $this->tituloAudio = $this->dadosActualGravacao->titulo_audio != null ? $this->dadosActualGravacao->titulo_audio : "";
        $this->estilo_id = $this->dadosActualGravacao->estilo_audio != null ? $this->dadosActualGravacao->estilo_audio : "";
        $this->dataGravacao = $this->dadosActualGravacao->data_gravacao != null ? $this->dadosActualGravacao->data_gravacao : "";
        $this->duracaoGravacao = $this->dadosActualGravacao->duracao != null ? $this->dadosActualGravacao->duracao : "";
        $todosParticipantes = GravacaoParticipante::where("gravacao_id", $this->idGravacao)->get();

        foreach ($todosParticipantes as $item) {
            $this->participantesEscolhidos[$item->participante_id] = $item->participante_id;
        }
    }

    public function buscarTodosParticipantes()
    {
        if ($this->cliente_id != null || $this->grupoEscolhido != null) {

            return Participante::where(function ($query) {
                $query->where('nome', 'like', '%' . $this->termoPesquisa . '%')
                    ->orWhere('user_id', 'like', '%' . $this->termoPesquisa . '%');
            })
                ->where(function ($query) {
                    $query->where('grupo_id', '!=', $this->grupoEscolhido)
                        ->orWhereNull('grupo_id');
                })
                ->where(function ($query) {
                    $query->where('user_id', '!=', $this->cliente_id)
                        ->orWhereNull('user_id');
                })
                ->orderBy("id", "desc")
                ->limit(9)
                ->get();
        } else {
            return array();
        }

    }

    public function buscarListaParaMembrosParaGrupo()
    {
        return User::where(function($query) {
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
        ]);

        $grupo = Grupo::where('nome', $this->nomeGrupo)->first();
        if ($grupo) {
            $this->emit('alerta', ['mensagem' => 'Este grupo já existe', 'icon' => 'warning', 'tempo' => 4500]);
            $this->nomeGrupo = null;
        } else {
            $grupo = Grupo::create(['nome' => $this->nomeGrupo]);
            Participante::create([
                'nome' => $grupo->nome . " (Grupo)",
                'grupo_id' => $grupo->id,
            ]);
            session()->put("grupo_id", $grupo->id);
            $this->emit('alerta', ['mensagem' => 'Grupo criado com sucesso', 'icon' => 'success']);
            $this->tbMembrosGrupo = true;
            $this->nomeGrupo = null;
        }
    }

    public function adicionarMembrosAoGrupo(){
        foreach ($this->clientesEscolhidos as $item) {
            GrupoCliente::create([
                "grupo_id" => session("grupo_id"),
                "membro" => $item,
            ]);
        }
        session()->forget("grupo_id");
        $this->emit('alerta', ['mensagem' => 'Membros adicionados com sucesso', 'icon' => 'success', 'tempo' => 5000]);
        $this->clientesEscolhidos = array();
        $this->tbMembrosGrupo = false;
    }

    public function registarParticipantes()
    {
        $this->validate([
            "nomeParticipante" => "required",
        ]);
        $particiapante = Participante::where('nome', $this->nomeParticipante . " (Anônimo)")->first();

        if ($particiapante) {
            $this->emit('alerta', ['mensagem' => 'Este participante já existe', 'icon' => 'warning', 'tempo' => 5000]);
        } else {
            Participante::create(['nome' => $this->nomeParticipante . " (Anônimo)"]);
            $this->emit('alerta', ['mensagem' => 'Registrado com sucesso', 'icon' => 'success']);
            $this->nomeParticipante = null;
        }
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
        return $dadosPartic ? $dadosPartic->nome . ", " : "";
    }

    public function actualizarAgendamento()
    {
        $this->validate([
            "tituloAudio" => "required",
            "estilo_id" => "required",
            "dataGravacao" => ["required", "regex:/^\d{4}-\d{2}-\d{2}T((0[8-9]|1[0-7]):[0-5][0-9]|18:00)$/"],
            "duracaoGravacao" => "required",
        ]);
        $this->verificarData();
    }

    public function verificarData()
    {
        $dataInserida = date("Y-m-d H:i:s", strtotime($this->dataGravacao));
        $gravacao = Gravacao::whereDate("data_gravacao", date("Y-m-d", strtotime($this->dataGravacao)))
            ->where("estado_gravacao", "!=", "gravado")
            ->where("id", "!=", $this->idGravacao)
            ->orderBy("created_at", "desc")
            ->first();

        if ($gravacao) {
            
            $dataDB = $gravacao->data_gravacao;
            $duracaoDB = (int) trim($gravacao->duracao, " hr");

            $dataObj = DateTime::createFromFormat('Y-m-d H:i:s', $dataDB);
            $dataObj->modify('+' . $duracaoDB . ' hours');
            $dataCarregada = $dataObj->format('Y-m-d H:i:s');

            if ($dataInserida >= $dataCarregada) {
                $this->inserirNaBD();
            } else {
                $this->emit('alerta', ['mensagem' => 'Existe um agendamento em processo nesta data', 'icon' => 'warning', 'tempo' => 5000]);
            }
        } else {
            $this->inserirNaBD();
        }
    }

    public function inserirNaBD(){
        $dados = [
            "cliente_id" => $this->cliente_id != null ? $this->cliente_id : null,
            "grupo_id" => $this->grupoEscolhido != null ? $this->grupoEscolhido : null,
            "titulo_audio" => $this->tituloAudio,
            "estilo_audio" => $this->estilo_id,
            "data_gravacao" => $this->dataGravacao,
            "estado_gravacao" => "pendente",
            "duracao" => $this->duracaoGravacao,
            "responsavel" => Auth::user()->id,
        ];

        if ($this->cliente_id == null && $this->grupoEscolhido == null) {
            $this->emit('alerta', ['mensagem' => 'Selecione 1 proprietário (Grupo ou Cliente) ', 'icon' => 'warning', 'tempo' => 5000]);
        }else if ($this->cliente_id != null && $this->grupoEscolhido != null) {
            $this->emit('alerta', ['mensagem' => 'Só é permitido 1 proprietário (Grupo ou Cliente)', 'icon' => 'warning', 'tempo' => 5000]);
        } else if ($this->cliente_id != null || $this->grupoEscolhido != null) {
            
            $gravacao = Gravacao::where("id", $this->idGravacao)->update($dados);
            GravacaoParticipante::where("gravacao_id", $this->idGravacao)->delete();
            
            foreach ($this->participantesEscolhidos as $item) {
                if($item){
                    GravacaoParticipante::create([
                        "gravacao_id" => $this->idGravacao,
                        "participante_id" => $item,
                    ]);
                }
            }
            $this->emit('alerta', ['mensagem' => 'Actualizado com sucesso', 'icon' => 'success', 'tempo' => 5000]);
            $this->msgParaRegistroActividade();
            $this->limparCampos();
            $this->emit('atrazar_redirect', ['caminho' => '/gravacao/listar', 'tempo' => 2500]);
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

    public function registrarActividade($msg, $tipo, $user_id)
    {
        RegistroActividade::create([
            "mensagem" => $msg,
            "tipo_msg" => $tipo,
            "user_id" => $user_id,
        ]);
    }

    public function msgParaRegistroActividade()
    {
        $nomeCliente = $this->buscarUtilizador($this->cliente_id);
        $nomeGrupo = $this->buscarGrupo($this->grupoEscolhido);
        $mebroEmGrupo = $this->buscarGrupoCliente($this->cliente_id);

        if (!empty($nomeCliente) && !empty($mebroEmGrupo)) {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Actualizou um agendamento de gravação para cliente $nomeCliente->name do grupo " . $this->buscarGrupo($mebroEmGrupo->grupo_id)->nome . " </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        }  elseif ($nomeCliente) {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Actualizou um agendamento de gravação para cliente $nomeCliente->name </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        } elseif ($nomeGrupo) {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Actualizou um agendamento de gravação para o grupo $nomeGrupo->nome </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        }
    }

    public function buscarUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarGrupo($id)
    {
        return Grupo::find($id);
    }

    public function buscarGrupoCliente($cliente_id)
    {
        return GrupoCliente::where("membro", $cliente_id)->first();
    }

    public function removerGrupoParticipanteJaSelecionado($grupoEscolhido)
    {
        $participanteGrupo = Participante::where("grupo_id", $grupoEscolhido)->first();
        if ($participanteGrupo && array_key_exists($participanteGrupo->id, $this->participantesEscolhidos)) {
            unset($this->participantesEscolhidos[$participanteGrupo->id]);
        }
    }

    public function removerClienteParticipanteJaSelecionado($clienteEscolhido)
    {
        $participanteCliente = Participante::where("user_id", $clienteEscolhido)->first();
        if ($participanteCliente && array_key_exists($participanteCliente->id, $this->participantesEscolhidos)) {
            unset($this->participantesEscolhidos[$participanteCliente->id]);
        }
    }

    public function buscarNomeGrupo($id)
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

    public function verRegistroAgendamento()
    {
        $gravacao = Gravacao::max("data_gravacao");
        $mixagem = Mixagem::max("data_mixagem");
        $masterizacao = Masterizacao::max("data_master");
        $ultimoHorario = max($gravacao, $mixagem, $masterizacao);

        if($ultimoHorario){
            $this->emit('alerta', [
                'icon' => "warning",
                'mensagem' => '<b> Último Agendamento: </b> ' . $this->formatarDataNormal($ultimoHorario) . '<br> <br> <b>Horário Disponível:</b> ' . $this->formatarDataNormal($this->dataMin) . " <br>",
                'btn' => true,
                'tempo' => 100000,
                'position' => 'center',
            ]);
        }else{
            $this->emit('alerta', [
                'icon' => "warning",
                'mensagem' => '<b>Horário Disponível:</b> ' . $this->formatarDataNormal($this->dataMin) . " <br>",
                'btn' => true,
                'tempo' => 100000,
                'position' => 'center',
            ]);
        }

    }

    public function formatarDataNormal($data){
        $formato = new DateTime($data);
        return $formato->format('d-m-Y H:i');
    }

    public function limparCampos()
    {
        $this->tbMembrosGrupo = false;
        $this->nomeGrupo = null;
        $this->nomeParticipante = null;
        $this->cliente_id = null;
        $this->grupoEscolhido = null;
        $this->tituloAudio = null;
        $this->estilo_id = null;
        $this->dataGravacao = null;
        $this->duracaoGravacao = null;
        $this->participantesEscolhidos = array();
        $this->participantesFiltrados = array();
        $this->termoPesquisa = '';
    }
}
