<?php

namespace App\Http\Livewire\Masterizacao;


use App\Models\Gravacao\Gravacao;
use App\Models\Gravacao\GravacaoParticipante;
use App\Models\Grupo\Grupo;
use App\Models\Masterizacao\Masterizacao;
use App\Models\Mixagem\Mixagem;
use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Actualizar extends Component
{
    public $idMasterizacao, $infoDispositivo, $gravacao_id, $dataMasterizacao, $duracaoMasterizacao;
    public $listaGravacoes = array();

    protected $messages = [
        "gravacao_id.required" => "Campo obrigatório",
        "dataMasterizacao.required" => "Campo obrigatório",
        "duracaoMasterizacao.required" => "Campo obrigatório",
    ];

    public function mount($idMasterizacao)
    {
        $this->idMasterizacao = $idMasterizacao;
        $this->buscarDadosDispositivo();
        $this->setarInicialmenteDadosMixagem();
    }

    public function index($idMasterizacao)
    {
        return view('index.masterizacao.actualizar', ["idMasterizacao" => $idMasterizacao]);
    }

    public function render()
    {
        $this->listaGravacoes = Gravacao::select("gravacaos.*")
            ->leftJoin('mixagems', 'gravacaos.id', '=', 'mixagems.gravacao_id')
            ->leftJoin('masterizacaos', 'mixagems.id', '=', 'masterizacaos.mixagem_id')
            ->where("gravacaos.estado_gravacao", "gravado")
            ->where("mixagems.estado_mixagem", "mixado")
            ->whereNotNull("masterizacaos.mixagem_id")
            ->distinct()
            ->get();
        return view('livewire.masterizacao.actualizar');
    }

    public function setarInicialmenteDadosMixagem(){
        $dadosActualMaster = Masterizacao::where("id", $this->idMasterizacao)->first();
        $dadosActualMixagem = Mixagem::where("id", $dadosActualMaster->mixagem_id)->first();
        $this->gravacao_id = $dadosActualMixagem ? $dadosActualMixagem->gravacao_id : null;
        $this->dataMasterizacao = $dadosActualMaster ? $dadosActualMaster->data_master : null;
        $this->duracaoMasterizacao = $dadosActualMaster ? $dadosActualMaster->duracao : null;
    }

    public function buscarUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarGrupo($id)
    {
        return Grupo::find($id);
    }

    public function msgParaRegistroActividade($cliente_id, $grupo_id)
    {
        $nomeCliente = $this->buscarUtilizador($cliente_id);
        $nomeGrupo = $this->buscarGrupo($grupo_id) ? $this->buscarGrupo($grupo_id)->name : "";
        if ($nomeCliente) {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Fez uma actualização no agendamento de masterização para cliente $nomeCliente->name </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        } elseif ($nomeGrupo) {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Fez uma actualização no agendamento de masterização para o grupo $nomeGrupo->nome </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
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

    public function buscarParticipantesGravacao($id)
    {
        return GravacaoParticipante::where("gravacao_id", $id)->get();
    }

    public function cortarUltimavirgula($todosParticipantes)
    {
        $particEscolhidos = '';
        $count = count($todosParticipantes);
        foreach ($todosParticipantes as $index => $item) {
            $nomeParticipante = $this->buscarNomeParticipante($item->participante_id);

            if ($index === 0) {
                $particEscolhidos .= $nomeParticipante;
            } elseif ($index === $count - 1) {
                $particEscolhidos .= " e $nomeParticipante";
            } else {
                $particEscolhidos .= ", $nomeParticipante";
            }
        }

        $particEscolhidos = str_replace(" (Grupo)", "", $particEscolhidos);
        $particEscolhidos = str_replace(" (Anônimo)", "", $particEscolhidos);
        return rtrim($particEscolhidos);
    }

    public function buscarNomeParticipante($id)
    {
        $dadosPartic = Participante::find($id);
        return $dadosPartic ? $dadosPartic->nome : "";
    }

    public function actualizarMasterizacao()
    {
        $this->validate([
            "gravacao_id" => "required",
            "dataMasterizacao" => "required",
            "duracaoMasterizacao" => "required",
        ]);

        $mixagem = Mixagem::where("gravacao_id",$this->gravacao_id)->first();
        $dados = [
            "mixagem_id" => $mixagem->id,
            "data_master" => $this->dataMasterizacao,
            "estado_master" => "pendente",
            "duracao" => $this->duracaoMasterizacao,
            "responsavel" => Auth::user()->id,
        ];
        Masterizacao::where("id", $this->idMasterizacao)->update($dados);
        $gravacao = Gravacao::find($this->gravacao_id);
        $this->msgParaRegistroActividade($gravacao->cliente_id, $gravacao->grupo_id);
        $this->emit('alerta', ['mensagem' => 'Agendamento actualizado com sucesso', 'icon' => 'success', 'tempo' => 5000]);
        $this->limparCampos();
    }

    public function registrarActividade($msg, $tipo, $user_id)
    {
        RegistroActividade::create([
            "mensagem" => $msg,
            "tipo_msg" => $tipo,
            "user_id" => $user_id,
        ]);
    }

    public function limparCampos()
    {
        $this->gravacao_id = null;
        $this->dataMasterizacao = null;
        $this->duracaoMasterizacao = null;
        $this->listaGravacoes = array();
    }
}
