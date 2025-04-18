<?php

namespace App\Http\Livewire\Masterizacao;


use App\Models\Gravacao\Gravacao;
use App\Models\Gravacao\GravacaoParticipante;
use App\Models\Grupo\Grupo;
use App\Models\Grupo\GrupoCliente;
use App\Models\Masterizacao\Masterizacao;
use App\Models\Mixagem\Mixagem;
use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Actualizar extends Component
{
    public $idMasterizacao, $infoDispositivo, $gravacao_id, $dataMasterizacao, $duracaoMasterizacao;
    public $listaGravacoes = array(), $dataMin;

    protected $messages = [
        "gravacao_id.required" => "Campo obrigatório",

        "dataMasterizacao.required" => "Campo obrigatório",
        "dataMasterizacao.regex" => "Só é possível agendar das 08:00 até 18:00",
        
        "duracaoMasterizacao.required" => "Campo obrigatório",
    ];

    public function mount($id)
    {
        $this->idMasterizacao = $id;
        $this->buscarDadosDispositivo();
        $this->setarInicialmenteDadosMixagem();
    }

    public function render()
    {
        $this->dataMinimaAgendamento();
        $this->listaGravacoes = Gravacao::select("gravacaos.*")
            ->leftJoin('mixagems', 'gravacaos.id', '=', 'mixagems.gravacao_id')
            ->leftJoin('masterizacaos', 'mixagems.id', '=', 'masterizacaos.mixagem_id')
            ->where("gravacaos.estado_gravacao", "gravado")
            ->where("mixagems.estado_mixagem", "mixado")
            ->whereNotNull("masterizacaos.mixagem_id")
            ->distinct()
            ->get();
        return view('livewire.masterizacao.actualizar')
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


    public function setarInicialmenteDadosMixagem(){
        $dadosActualMaster = Masterizacao::where("id", $this->idMasterizacao)->first();
        $dadosActualMixagem = Mixagem::where("id", $dadosActualMaster->mixagem_id)->first();
        $this->gravacao_id = $dadosActualMixagem ? $dadosActualMixagem->gravacao_id : null;
        $this->dataMasterizacao = $dadosActualMaster ? $dadosActualMaster->data_master : null;
        $this->duracaoMasterizacao = $dadosActualMaster ? $dadosActualMaster->duracao : null;
    }

    public function msgParaRegistroActividade($cliente_id, $grupo_id)
    {
        $nomeCliente = $this->buscarUtilizador($cliente_id);
        $nomeGrupo = $this->buscarGrupo($grupo_id) ? $this->buscarGrupo($grupo_id)->name : "";
        $mebroEmGrupo = $this->buscarGrupoCliente($cliente_id);

        if (!empty($nomeCliente) && !empty($mebroEmGrupo)) {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Actualizou um agendamento de masterização para cliente $nomeCliente->name do grupo " . $this->buscarGrupo($mebroEmGrupo->grupo_id)->nome . " </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        }else if ($nomeCliente) {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Actualizou um agendamento de masterização para cliente $nomeCliente->name </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        } elseif ($nomeGrupo) {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Actualizou um agendamento de masterização para o grupo $nomeGrupo->nome </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
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

    public function buscarGrupoCliente($cliente_id)
    {
        return GrupoCliente::where("membro", $cliente_id)->first();
    }

    public function buscarUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarGrupo($id)
    {
        return Grupo::find($id);
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
            "dataMasterizacao" => ["required", "regex:/^\d{4}-\d{2}-\d{2}T((0[8-9]|1[0-7]):[0-5][0-9]|18:00)$/"],
            "duracaoMasterizacao" => "required",
        ]);
        $this->verificarData();
    }

    public function verificarData()
    {
        $dataCarregadaGravacao = 0;
        $dataCarregadaMixagem = 0;
        $dataCarregadaMasterizacao = 0;
        $dataInserida = date("Y-m-d H:i:s", strtotime($this->dataMasterizacao));

        $gravacao = Gravacao::whereDate("data_gravacao", date("Y-m-d", strtotime($this->dataMasterizacao)))
            ->where("estado_gravacao", "!=", "gravado")
            ->orderBy("created_at", "desc")
            ->first();

        $mixagem = Mixagem::whereDate("data_mixagem", date("Y-m-d", strtotime($this->dataMasterizacao)))
            ->where("estado_mixagem", "!=", "mixado")
            ->orderBy("created_at", "desc")
            ->first();

        $masterizacao = Masterizacao::whereDate("data_master", date("Y-m-d", strtotime($this->dataMasterizacao)))
        ->where("estado_master", "!=", "masterizado")
        ->where("id", "!=", $this->idMasterizacao)
        ->orderBy("created_at", "desc")
        ->first();

        if ($gravacao || $mixagem || $masterizacao) {

            if ($gravacao) {
                $dataDBGravacao = $gravacao->data_gravacao;
                $duracaoDBGravacao = (int) trim($gravacao->duracao, " hr");
                $dataObjGravacao = DateTime::createFromFormat('Y-m-d H:i:s', $dataDBGravacao);
                $dataObjGravacao->modify('+' . $duracaoDBGravacao . ' hours');
                $dataCarregadaGravacao = $dataObjGravacao->format('Y-m-d H:i:s');
            } 

            if ($mixagem) {
                $dataDBMixagem = $mixagem->data_mixagem;
                $duracaoDBMixagem = (int) trim($mixagem->duracao, " hr");
                $dataObjMixagem = DateTime::createFromFormat('Y-m-d H:i:s', $dataDBMixagem);
                $dataObjMixagem->modify('+' . $duracaoDBMixagem . ' hours');
                $dataCarregadaMixagem = $dataObjMixagem->format('Y-m-d H:i:s');
            } 

            if ($masterizacao) {
                $dataDBMasterizacao = $masterizacao->data_masterizacao;
                $duracaoDBMasterizacao = (int) trim($masterizacao->duracao, " hr");
                $dataObjMasterizacao = DateTime::createFromFormat('Y-m-d H:i:s', $dataDBMasterizacao);
                $dataObjMasterizacao->modify('+' . $duracaoDBMasterizacao . ' hours');
                $dataCarregadaMasterizacao = $dataObjMasterizacao->format('Y-m-d H:i:s');
            } 

            if ($dataInserida >= $dataCarregadaGravacao && $dataInserida > $dataCarregadaMixagem && $dataInserida > $dataCarregadaMasterizacao) {
                $this->inserirNaBD();
            } else {
                $this->emit('alerta', ['mensagem' => 'Existe um agendamento em processo nesta data', 'icon' => 'warning', 'tempo' => 5000]);
            }
        } else {
               $this->inserirNaBD();
        }
    }

    public function inserirNaBD(){
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
        $this->gravacao_id = null;
        $this->dataMasterizacao = null;
        $this->duracaoMasterizacao = null;
        $this->listaGravacoes = array();
    }
}
