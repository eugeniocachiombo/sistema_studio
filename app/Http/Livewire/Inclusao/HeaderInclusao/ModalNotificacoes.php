<?php

namespace App\Http\Livewire\Inclusao\HeaderInclusao;

use App\Models\Gravacao\Gravacao;
use App\Models\Masterizacao\Masterizacao;
use App\Models\Mixagem\Mixagem;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class ModalNotificacoes extends Component
{
    public $agendaEmProrocesso, $tipoAgendamento, $data, $fimAgendaEmProcesso, $agendado;

    public function render()
    {
        $this->verRegistroAgendamento();
        return view('livewire.inclusao.header-inclusao.modal-notificacoes');
    }

    public function verRegistroAgendamento()
    {
        $gravacao = Gravacao::whereDate("data_gravacao", Carbon::today())->max("data_gravacao");
        $mixagem = Mixagem::whereDate("data_mixagem", Carbon::today())->max("data_mixagem");
        $masterizacao = Masterizacao::whereDate("data_master", Carbon::today())->max("data_master");
        $maiorData = max($gravacao, $mixagem, $masterizacao);

        if (!empty($maiorData)) {
            if ($maiorData == $gravacao) {
                $this->tipoAgendamento = "Gravação";
                $this->agendaEmProrocesso = $this->buscarComMaiorDataGravacao($maiorData);
                $this->data = $maiorData;
                $this->agendado = $this->agendaEmProrocesso->created_at;
            } else if ($maiorData == $mixagem) {
                $this->tipoAgendamento = "Mixagem";
                $this->agendaEmProrocesso = $this->buscarComMaiorDataMixagem($maiorData);
                $mixagem = Mixagem::where("data_mixagem", $maiorData)->first();
                $this->data = $maiorData;
                $this->agendado = $this->agendaEmProrocesso->created_at;
            } else if ($maiorData == $masterizacao) {
                $this->tipoAgendamento = "Masterização";
                $this->agendaEmProrocesso = $this->buscarComMaiorDataMasterizacao($maiorData);
                $masterizacao = Masterizacao::where("data_master", $maiorData)->first();
                $this->data = $maiorData;
                $this->agendado = $this->agendaEmProrocesso->created_at;
            }

            if (date("H:i") > $this->fimAgendaEmProcesso) {
                $this->agendaEmProrocesso = null;
                session()->forget("agendamentoEmProcesso");
            } else {
                $duracao = (int) trim($this->agendaEmProrocesso->duracao, " hr");
                $maiorHora = (int) date('H', strtotime($maiorData));
                $horaAgenda = $maiorHora + $duracao;
                $this->fimAgendaEmProcesso = date($horaAgenda + 1) . ":00";
                $this->data = date('H:i', strtotime($this->data));
                session()->put("agendamentoEmProcesso", "existe");
            }
        } else {
            session()->forget("agendamentoEmProcesso");
            $this->agendaEmProrocesso = null;
        }
    }

    public function buscarComMaiorDataGravacao($maiorData)
    {
        return Gravacao::where("data_gravacao", $maiorData)->first();
    }

    public function buscarComMaiorDataMixagem($maiorData)
    {
        return Gravacao::select("gravacaos.*")
            ->leftJoin('mixagems', 'gravacaos.id', '=', 'mixagems.gravacao_id')
            ->where("mixagems.data_mixagem", $maiorData)
            ->distinct()
            ->first();
    }

    public function buscarComMaiorDataMasterizacao($maiorData)
    {
        return Gravacao::select("gravacaos.*")
            ->leftJoin('mixagems', 'gravacaos.id', '=', 'mixagems.gravacao_id')
            ->leftJoin('masterizacaos', 'mixagems.id', '=', 'masterizacaos.mixagem_id')
            ->where("data_master", $maiorData)
            ->first();
    }

    public function formatarData($data)
    {
        $data_hora = new DateTime($data);
        $agora = new DateTime('now');
        $intervalo = $data_hora->diff($agora);

        if ($intervalo->days == 0) {
            if ($intervalo->h == 0) {
                $data_formatada = $intervalo->i . ' min';
            } else {
                $data_formatada = $intervalo->h . ' hr';
            }
        } elseif ($intervalo->days == 1) {
            $data_formatada = 'Ontem às ' . $data_hora->format('H:i');
        } elseif ($intervalo->days >= 2 && $intervalo->days <= 6) {
            $dias_semana = array(
                'Sunday' => 'Domingo',
                'Monday' => 'Segunda-feira',
                'Tuesday' => 'Terça-feira',
                'Wednesday' => 'Quarta-feira',
                'Thursday' => 'Quinta-feira',
                'Friday' => 'Sexta-feira',
                'Saturday' => 'Sábado',
            );
            $data_formatada = $data_hora->format('l \à\s H:i');
            $data_formatada = strtr($data_formatada, $dias_semana);
        } elseif ($intervalo->days >= 7) {
            $meses = array(
                'January' => 'Janeiro',
                'February' => 'Fevereiro',
                'March' => 'Março',
                'April' => 'Abril',
                'May' => 'Maio',
                'June' => 'Junho',
                'July' => 'Julho',
                'August' => 'Agosto',
                'September' => 'Setembro',
                'October' => 'Outubro',
                'November' => 'Novembro',
                'December' => 'Dezembro',
            );
            $data_formatada = $data_hora->format('d \d\e F \d\e Y');
            $data_formatada = strtr($data_formatada, $meses);
        }
        return $data_formatada;
    }
}
