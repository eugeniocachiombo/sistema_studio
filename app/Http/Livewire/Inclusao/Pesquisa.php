<?php

namespace App\Http\Livewire\Inclusao;

use Livewire\Component;

class Pesquisa extends Component
{
    public $valorPesquisa = null;
    public $resultados = array();

    public function render()
    {
        return view('livewire.inclusao.pesquisa');
    }
}
