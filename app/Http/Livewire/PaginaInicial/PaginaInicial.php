<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaginaInicial extends Component
{
    public $gravacao;
    public $mixagem;
    public $masterizacao;
    public $utilizador_id;
    public $utilizadorLogado;
    public $listaClientes = array();

    public function mount()
    {
        $this->listaClientes = User::where("tipo_acesso", 3)->get();
        $this->utilizador_id = Auth::user()->id;
    }

    public function index()
    {
        return view('index.pagina-inicial.pagina-inicial');
    }

    public function render()
    {
        $this->utilizadorLogado = $this->buscarDadosUtilizador($this->utilizador_id);
        return view('livewire.pagina-inicial.pagina-inicial');
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }
}
