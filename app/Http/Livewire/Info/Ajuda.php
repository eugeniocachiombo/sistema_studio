<?php

namespace App\Http\Livewire\Info;

use Livewire\Component;

class Ajuda extends Component
{
    public function render()
    {
        return view('livewire.info.ajuda')
        ->layout("layouts.logado.app");
    }
}
