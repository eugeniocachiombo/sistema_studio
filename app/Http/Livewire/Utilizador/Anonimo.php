<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\Acesso\Acesso;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use App\Models\Utilizador\Pessoa;
use DateTime;
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
        return view('index.utilizador.anonimo', ["id" => $id]);
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
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
        $data_objeto = new DateTime($data);
        $data_formatada = $data_objeto->format('d \d\e F \d\e Y');
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
