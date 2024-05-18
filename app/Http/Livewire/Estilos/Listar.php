<?php

namespace App\Http\Livewire\Estilos;

use App\Models\Estilo\Estilo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Listar extends Component
{
    public $utilizador;
    public $listaEstilo = array();

    public function mount(){
        $this->utilizador = Auth::user();
    }

    public function index()
    {
        return view('index.estilos.listar');
    }

    public function render()
    {
        $this->listaEstilo = Estilo::all();
        return view('livewire.estilos.listar');
    }

    public function eliminarEstilo($id){
        Estilo::find($id)->delete();
        $this->emit('alerta', ['mensagem' => 'Estilo eliminado do sistema', 'icon' => 'success', 'tempo' => 5000]);
        $this->emit('atrazar_redirect', ['caminho' => '/estilos/listar', 'tempo' => 2500]);
    }
}
