<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\User;
use App\Models\Utilizador\Pessoa;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TbClientes extends Component
{
    public $listaClientes = array();
    public $utilizador_id;
    
    public function render()
    {
        $this->utilizador_id = Auth::user()->id;
        $this->listaClientes = User::where("tipo_acesso", 3)->orderby("id", "desc")->get();
        return view('livewire.pagina-inicial.tb-clientes');
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

    public function buscarDadosPessoais($idUtilizador)
    {
        return Pessoa::where("user_id", $idUtilizador)->first();
    }
}
