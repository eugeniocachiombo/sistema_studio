<?php

namespace App\Http\Livewire\Utilizador;

use Livewire\Component;

class PrepararAmbiente extends Component
{
    public function mount()
    {
        if (session('utilizador') && session("ambientePreparado") != "true"){
            session()->put("ambientePreparado", "true");
            return view('livewire.utilizador.preparar-ambiente');
        }else{
            return redirect()->route("utilizador.autenticacao");
        }
    }

    public function render()
    {
        return view('livewire.utilizador.preparar-ambiente')
        ->layout("layouts.deslogado.app");
    }
}
