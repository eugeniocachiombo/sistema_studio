<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class TerminarSessao extends Component
{
    public $infoDispositivo;

    public function mount(){
        $this->buscarDadosDispositivo();
    }

    public function index()
    {
        return view('index.utilizador.terminar-sessao');
    }

    public function render()
    {
        $this->registrarActividade("<b>Terminou a sessão no sistema</b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        Auth::logout();
        session()->forget("ambientePreparado");
        session()->forget("utilizador");
        cookie("sessao_iniciada", '', 0);
        return view('livewire.utilizador.terminar-sessao');
    }

    public function buscarDadosDispositivo(){
        $agente = new Agent();
        $dispositivo = $agente->device();
        $plataforma = $agente->platform();
        $versaoPlataforma = $agente->version($plataforma);
        $navegador = $agente->browser();
        $versaoNavegador = $agente->version($navegador);
        $this->infoDispositivo = "<b class='text-primary'>Dispositivo:</b> " . $agente->device() . " <br>".
        "<b class='text-primary'>Plataforma:</b> " . $plataforma . " " . $versaoPlataforma . " <br>".
        "<b class='text-primary'>Navegador:</b> " . $navegador . " " . $versaoNavegador . " ";
    }

    public function registrarActividade($msg, $tipo, $user_id){
        RegistroActividade::create( [
            "mensagem" => $msg,
            "tipo_msg" => $tipo,
            "user_id" => $user_id,
        ]);
    }
}
