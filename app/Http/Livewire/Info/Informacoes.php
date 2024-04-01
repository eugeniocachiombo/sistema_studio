<?php

namespace App\Http\Livewire\Info;

use Livewire\Component;

class Informacoes extends Component
{
    public function ajuda()
    {
        return view('index.info.ajuda');
    }

    public function contacto()
    {
        return view('index.info.contacto');
    }

    public function sobre()
    {
        return view('index.info.sobre');
    }
}
