<?php

namespace App\Http\Livewire\Gravacao;

use Livewire\Component;

class Agendar extends Component
{

    public function index()
    {
        return view('index.gravacao.agendar');
    }

    public function render()
    {
        return view('livewire.gravacao.agendar');
    }
}
