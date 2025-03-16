<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;
use Illuminate\Support\Str;

class TerminarSessao extends Component
{
    public $infoDispositivo;

    public function mount(){
        $this->buscarDadosDispositivo();
    }

    public function render()
    {
        $this->registrarUltimoLogin(Auth::user()->id);
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Terminou a sessão no sistema</b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        Auth::logout();
        session()->forget("ambientePreparado");
        session()->forget("utilizador");
        cookie("sessao_iniciada", '', 0);
        return view('livewire.utilizador.terminar-sessao')
        ->layout("layouts.deslogado.app");
    }

    public function registrarUltimoLogin($id){
        User::where('id', $id)->update([
            'email_verified_at' => now(), 
            'remember_token' => Str::random(10),
        ]);
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
