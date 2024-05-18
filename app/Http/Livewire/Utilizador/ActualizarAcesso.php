<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\Acesso\Acesso;
use App\Models\User;
use Livewire\Component;

class ActualizarAcesso extends Component
{
    public $tipo_acesso_id;
    public $utilizador_id;
    public $dadosUtilizador;
    public $listaAcessos;

    public function mount($id)
    {
        $this->utilizador_id = $id;
    }

    public function index($id)
    {
        return view('index.utilizador.actualizar-acesso', ["id" => $id]);
    }

    public function render()
    {
        $this->dadosUtilizador = User::where("id", $this->utilizador_id)->first();
        $this->listaAcessos = Acesso::all();
        return view('livewire.utilizador.actualizar-acesso');
    }

    public function actualizarAcesso(){
        User::where("id", $this->utilizador_id)->update(["tipo_acesso" => $this->tipo_acesso_id]);
        $this->emit('alerta', ['mensagem' => 'Acesso do utilizador alterado', 'icon' => 'success', 'tempo' => 5000]);
        $this->emit('atrazar_redirect', ['caminho' => '/pagina_inicial', 'tempo' => 2500]);
    }
}
