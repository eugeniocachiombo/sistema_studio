<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\Gravacao\Gravacao;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaginaInicial extends Component
{
    public $utilizador_id, $utilizadorLogado;

    public function mount()
    {
        $this->utilizador_id = Auth::user()->id;
    }

    public function render()
    {
        $this->utilizadorLogado = User::find($this->utilizador_id);
        return view('livewire.pagina-inicial.pagina-inicial')
        ->layout("layouts.logado.app");
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }
}
