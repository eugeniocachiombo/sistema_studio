<?php

namespace App\Http\Livewire\Gravacao;

use App\Models\Gravacao\Estilo;
use App\Models\Gravacao\Gravacao;
use App\Models\Gravacao\GravacaoParticipante;
use App\Models\Grupo\Grupo;
use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use DateTime;
use Livewire\Component;

class Concluir extends Component
{
    public $listaGravacao = array();

    public function index()
    {
        return view('index.gravacao.concluir');
    }

    public function render()
    {
        $this->listaGravacao = Gravacao::all();
        return view('livewire.gravacao.concluir');
    }

    public function buscarUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarGrupo($id)
    {
        return Grupo::find($id);
    }

    public function buscarEstilos($id)
    {
        return Estilo::find($id);
    }

    public function buscarParticipantesGravacao($id)
    {
        return GravacaoParticipante::where("gravacao_id", $id)->get();
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

    public function buscarNomeParticipante($id)
    {
        $dadosPartic = Participante::find($id);
        return $dadosPartic ? $dadosPartic->nome : "";
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

    public function concluirAgendamento($idGravacao){
        Gravacao::where("id", $idGravacao)->update([
            "estado_gravacao" => "gravado"
        ]);
        $this->emit('alerta', ['mensagem' => 'Agendamento concluido com sucesso', 'icon' => 'success']);
        $this->emit('atrazar_redirect', ['caminho' => '/gravacao/concluir', 'tempo' => 2500]);
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
