<?php

namespace App\Http\Livewire\PaginaInicial;

use Livewire\Component;

class PaginaInicial extends Component
{
    public function index()
    {
        return view('index.pagina-inicial.pagina-inicial');
    }

    public function render()
    {
        return view('livewire.pagina-inicial.pagina-inicial');
    }
}
