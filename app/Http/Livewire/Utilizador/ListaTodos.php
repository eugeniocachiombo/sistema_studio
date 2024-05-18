<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use DateTime;
use Livewire\Component;

class ListaTodos extends Component
{
    public $listaUtilizadores;

    public function index()
    {
        return view('index.utilizador.lista-todos');
    }

    public function render()
    {
        $this->listaUtilizadores = User::all();
        return view('livewire.utilizador.lista-todos');
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

    public function formatarDataNormal($data){
        $formato = new DateTime($data);
        return $formato->format('d-m-Y H:i');
    }
}
