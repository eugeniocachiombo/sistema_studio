<?php

namespace App\Http\Livewire\Inclusao;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Header extends Component
{
    public $utilizador_id = null;

    public function mount()
    {
        $this->utilizador_id = 1;
    }

    public function render()
    {
        return view('livewire.inclusao.header');
    }

   /* public function listarTodasConversas()
    {
      /  return DB::select('select * from conversas ' .
            ' where (emissor = ' . $this->utilizador_id . ' and receptor = ' . $this->utilizador_id;
          
    }*/
}
