<?php

namespace App\Http\Livewire\Utilizador;

use Livewire\Component;

class TerminarSessao extends Component
{
    public function index()
    {
        return view('index.utilizador.terminar-sessao');
    }

    public function render()
    {
        session()->forget("ambientePreparado");
        session()->forget("utilizador");
        return view('livewire.utilizador.terminar-sessao');
    }
}
