<?php

namespace App\Http\Livewire\Utilizador;

use Livewire\Component;

class Perfil extends Component
{
    public function index()
    {
        if (session('utilizador')){
            return view('index.utilizador.perfil');
        }else{
            return view('index.utilizador.autenticacao');
        }
    }

    public function render()
    {
        return view('livewire.utilizador.perfil');
    }
}
