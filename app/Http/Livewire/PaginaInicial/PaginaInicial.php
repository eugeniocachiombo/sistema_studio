<?php

namespace App\Http\Livewire\PaginaInicial;

use Livewire\Component;

class PaginaInicial extends Component
{
    public function index()
    {
        if (session('utilizador')){
            return view('index.pagina-inicial.pagina-inicial');
        }else{
            return redirect()->route("utilizador.autenticacao");
        }
    }

    public function render()
    {
        return view('livewire.pagina-inicial.pagina-inicial');
    }
}
