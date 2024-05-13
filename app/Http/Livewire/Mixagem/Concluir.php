<?php

namespace App\Http\Livewire\Mixagem;

use App\Models\Gravacao\Gravacao;
use App\Models\Gravacao\GravacaoParticipante;
use App\Models\Grupo\Grupo;
use App\Models\Mixagem\Mixagem;
use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use DateTime;
use Livewire\Component;

class Concluir extends Component
{
    public $listaGravacoes = array();

    public function index()
    {
        return view('index.mixagem.concluir');
    }

    public function render()
    {
        $this->listaGravacoes = Gravacao::select("gravacaos.*")
            ->leftJoin('mixagems', 'gravacaos.id', '=', 'mixagems.gravacao_id')
            ->where("gravacaos.estado_gravacao", "gravado")
            ->whereNotNull("mixagems.id")
            ->distinct()
            ->get();
        return view('livewire.mixagem.concluir');
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

    public function buscarDadosMixagem($idGravacao)
    {
        return Mixagem::where("gravacao_id", $idGravacao)->first();
    }

    public function concluirAgendamento($idMixagem){
        Mixagem::where("id", $idMixagem)->update([
            "estado_mixagem" => "mixado"
        ]);
        $this->emit('alerta', ['mensagem' => 'Agendamento concluido com sucesso', 'icon' => 'success']);
        $this->emit('atrazar_redirect', ['caminho' => '/mixagem/concluir', 'tempo' => 2500]);
    }

    public function formatarData($data)
    {
        $data_hora = new DateTime($data);
        $agora = new DateTime('now');
        $diferenca = $data_hora->diff($agora)->days;
        if ($diferenca == 0) {
            $data_formatada = 'Hoje às ' . $data_hora->format('H:i');
        } elseif ($diferenca == 1) {
            $data_formatada = 'Ontem às ' . $data_hora->format('H:i');
        } elseif ($diferenca >= 2 && $diferenca <= 6) {
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
        } elseif ($diferenca >= 7) {
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
            $data_formatada = $data_hora->format('d \d\e F \d\e Y \à\s H:i');
            $data_formatada = strtr($data_formatada, $meses);
        }
        return $data_formatada;
    }
}
