<?php

namespace App\Http\Livewire\Estilos;

use App\Models\Estilo\Estilo;
use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Actualizar extends Component
{
    public $estilo_id;
    public $tipo;
    public $preco;
    public $listaEstilos;
    public $infoDispositivo;
    public $dadosActualEstilo;

    protected $messages = [
        "preco.required" => "Campo obrigatório",
        "tipo.required" => "Escreva o tipo de estilo",
    ];

    public function mount($id)
    {
        $this->estilo_id = $id;
        $this->setarInicialmenteDadosEstilo();
        $this->buscarDadosDispositivo();
    }

    public function render()
    {
        $this->listaEstilos = Estilo::all();
        return view('livewire.estilos.actualizar')
        ->layout("layouts.logado.app");
    }

    public function setarInicialmenteDadosEstilo()
    {
        $this->dadosActualEstilo = Estilo::where("id", $this->estilo_id)->first();
        $this->tipo = $this->dadosActualEstilo->tipo;
        $this->preco = $this->dadosActualEstilo->preco;
    }

    public function actualizarEstilo()
    {
        $this->validate([
            "tipo" => "required",
            "preco" => "required",
        ]);

        Estilo::where("id", $this->estilo_id)->update([
            'tipo' => $this->tipo,
            'preco' => $this->preco,
            'responsavel' => Auth::user()->id,
        ]);

        $this->emit('alerta', ['mensagem' => 'Estilo actualizado com sucesso', 'icon' => 'success']);
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Actualizou dados de um estilo  </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
        $this->emit('atrazar_redirect', ['caminho' => '/estilos/listar', 'tempo' => 2500]);
        $this->tipo = null;
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

    public function limparCampos()
    {
        $this->tipo = null;
    }
}
