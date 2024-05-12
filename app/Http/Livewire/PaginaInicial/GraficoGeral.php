<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\Gravacao\Gravacao;
use App\Models\Masterizacao\Masterizacao;
use App\Models\Mixagem\Mixagem;
use App\Models\User;
use Livewire\Component;

class GraficoGeral extends Component
{
    public $totalClientes;
    public $totalFuncionarios;
    public $totalGravacoes;
    public $totalMixagem;
    public $totalMasterizacao;

    public function render()
    {
        $this->totalGravacoes = Gravacao::all();
        $this->totalMixagem = Mixagem::all();
        $this->totalMasterizacao = Masterizacao::all();
        $this->totalClientes = User::where("tipo_acesso", 3)->get();
        $this->totalFuncionarios = User::where("tipo_acesso", "!=", 3)->get();
        return view('livewire.pagina-inicial.grafico-geral');
    }
}
