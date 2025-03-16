<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\Acesso\Acesso;
use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class ActualizarAcesso extends Component
{
    public $tipo_acesso_id;
    public $utilizador_id;
    public $dadosUtilizador;
    public $listaAcessos;
    public $infoDispositivo;

    public function mount($id)
    {
        $this->utilizador_id = $id;
        $this->buscarDadosDispositivo();
    }

    public function render()
    {
        $this->dadosUtilizador = User::where("id", $this->utilizador_id)->first();
        $this->listaAcessos = Acesso::all();
        return view('livewire.utilizador.actualizar-acesso')
        ->layout("layouts.logado.app");
    }

    public function actualizarAcesso(){
        User::where("id", $this->utilizador_id)->update(["tipo_acesso" => $this->tipo_acesso_id]);
        $this->emit('alerta', ['mensagem' => 'Acesso do utilizador alterado', 'icon' => 'success', 'tempo' => 5000]);
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Alterou o acesso de " .  User::find($this->utilizador_id)->name . " </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        $this->emit('atrazar_redirect', ['caminho' => '/pagina_inicial', 'tempo' => 2500]);
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
