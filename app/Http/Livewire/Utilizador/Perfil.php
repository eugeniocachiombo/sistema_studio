<?php

namespace App\Http\Livewire\Utilizador;

use Livewire\Component;

class Perfil extends Component
{
    public function index()
    {
        return view('index.utilizador.perfil');
    }

    public function render()
    {
        return view('livewire.utilizador.perfil');
    }
}
