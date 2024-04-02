<?php

namespace App\Http\Livewire\Inclusao;

use Livewire\Component;

class Pesquisa extends Component
{
    public $valorPesquisa = null;
    public $resultados = array();
    public $options = [
        ['label' => 'Opção 1', 'value' => 'opcao1', 'link' => '/link-para-opcao1'],
        ['label' => 'Opção 2', 'value' => 'opcao2', 'link' => '/link-para-opcao2'],
        ['label' => 'Opção 3', 'value' => 'opcao3', 'link' => '/link-para-opcao3'],
    ];

    public function pesquisar(){
        if (!in_array($this->valorPesquisa, $this->resultados)) {
           array_push($this->resultados, $this->valorPesquisa);
        }
    }

    public function render()
    {
        return view('livewire.inclusao.pesquisa');
    }
}
