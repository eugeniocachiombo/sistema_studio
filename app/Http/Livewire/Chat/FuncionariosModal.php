<?php

namespace App\Http\Livewire\Chat;

use App\Models\Acesso\Acesso;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FuncionariosModal extends Component
{
    public $listaFuncionarios;
    public $utilizador_id;
    
    public function mount()
    {
        $this->utilizador_id = Auth::user()->id;
    }

    public function render()
    {
        $this->listaFuncionarios = User::where("tipo_acesso", "!=", "3")
        ->where("id", "!=", $this->utilizador_id)
        ->get();
        return view('livewire.chat.funcionarios-modal');
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarTipoAcesso($id){
        return Acesso::where("id", $id)->first();
    }

    public function buscarFotoPerfil($idUtilizador){
        $foto = FotoPerfil::where("user_id", $idUtilizador)->orderby("id", "desc")->first();
        if ($foto) {
           $caminho = public_path('assets/' . $foto->caminho_arquivo);
           if (file_exists($caminho)) {
               return $foto;
           } else {
               return null;
           }
        }else{
           return null;
        }
   }
}
