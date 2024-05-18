<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaAtendentes extends Component
{
    public $listaUtilizadores;

    public function index()
    {
        return view('index.utilizador.lista-atendentes');
    }

    public function render()
    {
        $this->listaUtilizadores = User::where("tipo_acesso", "=", 2)->get();
        return view('livewire.utilizador.lista-atendentes');
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

    public function eliminarUtilizador($id){
        User::find($id)->delete();
        $this->emit('alerta', ['mensagem' => 'Utilizador eliminado do sistema', 'icon' => 'success', 'tempo' => 5000]);
        $this->emit('atrazar_redirect', ['caminho' => '/utilizador/listagem/todos', 'tempo' => 2500]);
    }

    public function buscarNascimento($data)
    {
        $meses = array(
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro',
        );

        $data_objeto = new DateTime($data);
        $dia = $data_objeto->format('d');
        $mes_num = $data_objeto->format('m');
        $mes = $meses[$mes_num];
        $ano = $data_objeto->format('Y');

        $data_formatada = "$dia de $mes de $ano";
        $data_formatada = mb_convert_case($data_formatada, MB_CASE_TITLE, "UTF-8");
        return $data_formatada;
    }
}