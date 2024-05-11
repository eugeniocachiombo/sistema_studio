<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\Gravacao\Gravacao;
use App\Models\User;
use Livewire\Component;

class GraficoGeral extends Component
{
    public $totalClientes;
    public $totalFuncionarios;
    public $totalGravacoes;

    public function render()
    {
        $this->totalGravacoes = Gravacao::all();
        $this->totalClientes = User::where("tipo_acesso", 3)->get();
        $this->totalFuncionarios = User::where("tipo_acesso", "!=", 3)->get();
        return view('livewire.pagina-inicial.grafico-geral');
    }
}
