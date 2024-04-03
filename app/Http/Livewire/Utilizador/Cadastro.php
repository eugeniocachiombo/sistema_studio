<?php

namespace App\Http\Livewire\Utilizador;

use Livewire\Component;

class Cadastro extends Component
{
    public function index()
    {
        if (session('utilizador')){
            return redirect()->route("pagina_inicial.");
        }else{
            return view('index.utilizador.cadastro');
        }
    }

    public function render()
    {
        return view('livewire.utilizador.cadastro');
    }
}
