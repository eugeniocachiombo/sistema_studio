<?php

namespace App\Http\Livewire\Utilizador;

use Livewire\Component;

class PrepararAmbiente extends Component
{
    public function index()
    {
        if (session('utilizador') && session("ambientePreparado") != "true"){
            session()->put("ambientePreparado", "true");
            return view('index.utilizador.preparar-ambiente');
        }else{
            return redirect()->route("utilizador.autenticacao");
        }
    }

    public function render()
    {
        return view('livewire.utilizador.preparar-ambiente');
    }
}
