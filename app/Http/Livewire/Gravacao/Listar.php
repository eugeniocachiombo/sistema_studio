<?php

namespace App\Http\Livewire\Gravacao;

use Livewire\Component;

class Listar extends Component
{
    public function index()
    {
        return view('index.gravacao.listar');
    }

    public function render()
    {
        return view('livewire.gravacao.listar');
    }
}
