<?php

namespace App\Http\Livewire\Inclusao;

use App\Models\chat\Conversa as ChatConversa;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Header extends Component
{
    public $utilizador_id = null, $idRemente=null;
    public $todasConversasGeral = array();
    public $listaParticipantes = array();
    public $todasPendentes = array();
    public $listeners = ['tempoRealMensagens'];

    public function mount()
    {
        $this->utilizador_id = Auth::user()->id;
    }

    public function render()
    {
        $this->todasConversasGeral = $this->listarTodasConversasGeral();
        $this->listaParticipantes = $this->listarParticipantes();
        return view('livewire.inclusao.header'); 
    }

    public function tempoRealMensagens(){

    }

    public function travarTempoReal(){
        if (isset($this->listeners['tempoRealMensagens'])) {
            $this->listeners['tempoRealMensagens'] = "";
        }
        sleep(5);
        $this->listeners = ['tempoRealMensagens'];
    }
    

    public function listarTodasConversasGeral()
    {
        return ChatConversa::where(function ($query) {
            $query->where('emissor', $this->utilizador_id)
                ->where('receptor', '!=', $this->utilizador_id);
        })
            ->orWhere(function ($query) {
                $query->where('receptor', $this->utilizador_id)
                    ->where('emissor', '!=', $this->utilizador_id);
            })
            ->where('estado', 'pendente')
            ->distinct()
            ->get();
    }

    public function ultimaMensagem($idRemente)
    {
        $this->idRemente = $idRemente;
        return ChatConversa::where(function ($query) {
            $query->where('emissor', $this->utilizador_id)
                ->where('receptor', $this->idRemente);
        })
            ->orWhere(function ($query) {
                $query->where('receptor', $this->utilizador_id)
                    ->where('emissor', $this->idRemente);
            })
            ->orderBy("id", "desc")
            ->limit(1)
            ->first();
    }

    public function msgPendentes()
    {
        return ChatConversa::where(function ($query) {
            $query->where('emissor', $this->utilizador_id)
                ->where('receptor', $this->idRemente)
                ->where('estado', 'pendente');
            })
        ->orWhere(function ($query) {
                $query->where('receptor', $this->utilizador_id)
                    ->where('emissor', $this->idRemente)
                    ->where('estado', 'pendente');
            })
        ->get();
    }

    public function msgPendentesGeral()
    {
        return ChatConversa::where('receptor', $this->utilizador_id)
        ->where('estado', 'pendente')
        ->get();
    }
    
    public function totalParticipantesPendentes()
    {
        return ChatConversa::where('receptor', $this->utilizador_id)
        ->where('estado', 'pendente')
        ->select("emissor")
        ->distinct()
        ->get();
    }

    public function listarParticipantes()
    {
        $conversas = ChatConversa::where(function ($query) {
            $query->where('emissor', $this->utilizador_id)
                ->where('receptor', '!=', $this->utilizador_id);
        })
            ->orWhere(function ($query) {
                $query->where('receptor', $this->utilizador_id)
                    ->where('emissor', '!=', $this->utilizador_id);
            })
            ->orderby('id', 'desc')
            ->distinct()
            ->get();

        $emissoresReceptores = [];
        foreach ($conversas as $conversa) {
            $emissoresReceptores[] = $conversa->emissor;
            $emissoresReceptores[] = $conversa->receptor;
        }

        $emissoresReceptores = array_unique($emissoresReceptores);
        $emissoresReceptores = array_diff($emissoresReceptores, [$this->utilizador_id]);
        $emissoresReceptores = array_values($emissoresReceptores);
        return $emissoresReceptores;
    }

    public function buscarNomeUsuario($id)
    {
        return User::find($id)->name;
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
