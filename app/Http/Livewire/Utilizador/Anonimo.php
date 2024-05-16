<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\Acesso\Acesso;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use App\Models\Utilizador\Pessoa;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Anonimo extends Component
{
    public $utilizador_id = null;
    public $tabVisaoGeral = null, $tabConteudoVisaoGeral = null;

    public function mount($id)
    {
        $this->tabVisaoGeral = "active";
        $this->tabConteudoVisaoGeral = "show active";
        $this->utilizador_id = $id;
    }

    public function index($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('utilizador.perfil');
        } else {
            return view('index.utilizador.anonimo', ["id" => $id]);
        }
    }

    public function render()
    {
        return view('livewire.utilizador.anonimo');
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarDadosPessoais($idUtilizador)
    {
        return Pessoa::where("user_id", $idUtilizador)->first();
    }

    public function buscarTipoAcesso($id)
    {
        return Acesso::find($id);
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
}
