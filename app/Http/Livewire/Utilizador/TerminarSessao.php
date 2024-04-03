<?php

namespace App\Http\Livewire\Utilizador;

use Livewire\Component;

class TerminarSessao extends Component
{
    public function index()
    {
        if (session('utilizador')){
            return view('index.utilizador.terminar-sessao');
        }else{
            return redirect()->route("utilizador.autenticacao");
        }
    }

    public function render()
    {
        session()->forget("ambientePreparado");
        session()->forget("utilizador");
        return view('livewire.utilizador.terminar-sessao');
    }
}
