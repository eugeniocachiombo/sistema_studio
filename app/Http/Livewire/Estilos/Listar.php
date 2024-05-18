<?php

namespace App\Http\Livewire\Estilos;

use App\Models\Estilo\Estilo;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Listar extends Component
{
    public $utilizador, $infoDispositivo;
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
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Eliminou o estilo do tipo " .  Estilo::find($id)->tipo . " </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id); 
        Estilo::find($id)->delete();
        $this->emit('alerta', ['mensagem' => 'Estilo eliminado do sistema', 'icon' => 'success', 'tempo' => 5000]);
        $this->emit('atrazar_redirect', ['caminho' => '/estilos/listar', 'tempo' => 2500]);
    }

    public function registrarActividade($msg, $tipo, $user_id)
    {
        RegistroActividade::create([
            "mensagem" => $msg,
            "tipo_msg" => $tipo,
            "user_id" => $user_id,
        ]);
    }

    public function buscarDadosDispositivo()
    {
        $agente = new Agent();
        $dispositivo = $agente->device();
        $plataforma = $agente->platform();
        $versaoPlataforma = $agente->version($plataforma);
        $navegador = $agente->browser();
        $versaoNavegador = $agente->version($navegador);
        $this->infoDispositivo = "<b class='text-primary'>Dispositivo:</b> " . $agente->device() . " <br>" .
            "<b class='text-primary'>Plataforma:</b> " . $plataforma . " " . $versaoPlataforma . " <br>" .
            "<b class='text-primary'>Navegador:</b> " . $navegador . " " . $versaoNavegador . " ";
    }
}
