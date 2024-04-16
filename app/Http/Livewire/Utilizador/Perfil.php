<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Perfil extends Component
{
    public $utilizador_id; 
    
    public function mount()
    {
        $this->utilizador_id = Auth::user()->id;
    }
    
    public function index()
    {
        return view('index.utilizador.perfil');
    }

    public function render()
    {
        return view('livewire.utilizador.perfil');
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }
}
