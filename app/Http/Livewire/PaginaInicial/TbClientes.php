<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\User;
use Livewire\Component;

class TbClientes extends Component
{
    public $listaClientes = array();
    
    public function render()
    {
        $this->listaClientes = User::where("tipo_acesso", 3)->get();
        return view('livewire.pagina-inicial.tb-clientes');
    }
}
