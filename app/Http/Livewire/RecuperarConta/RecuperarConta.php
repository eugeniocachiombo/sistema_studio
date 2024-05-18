<?php

namespace App\Http\Livewire\RecuperarConta;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecuperarConta extends Component
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('pagina_inicial.');
        }
        return view('index.recuperar-conta.recuperar-conta');
    }

    public function render()
    {
        return view('livewire.recuperar-conta.recuperar-conta');
    }
}
