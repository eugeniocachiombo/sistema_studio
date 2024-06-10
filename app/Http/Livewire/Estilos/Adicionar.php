<?php

namespace App\Http\Livewire\Estilos;

use App\Models\Estilo\Estilo;
use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Adicionar extends Component
{
    public $tipo;
    public $preco;
    public $listaEstilos;
    public $infoDispositivo;

    protected $messages = [
        "preco.required" => "Campo obrigatório",
        "tipo.required" => "Escreva o tipo de estilo",
    ];

    public function mount()
    {
        $this->buscarDadosDispositivo();
    }

    public function index()
    {
        return view('index.estilos.adicionar');
    }

    public function render()
    {
        $this->listaEstilos = Estilo::all();
        return view('livewire.estilos.adicionar');
    }

    public function criarEstilo()
    {
        $this->validate([
            "tipo" => "required",
            "preco" => "required",
        ]);

        $estilo = Estilo::where('tipo', $this->tipo)->first();
        $this->verificarSeEstiloExiste($estilo);
    }

    public function verificarSeEstiloExiste($estilo){
        if ($estilo) {
            $this->emit('alerta', ['mensagem' => 'Este estilo já existe', 'icon' => 'warning', 'tempo' => 4500]);
            $this->tipo = null;
        } else {
            $this->inserirNaBD();
        }
    }

    public function inserirNaBD(){
        $estilo = Estilo::create([
            'tipo' => $this->tipo,
            'preco' => $this->preco,
            'responsavel' => Auth::user()->id,
        ]);
        $this->emit('alerta', ['mensagem' => 'Estilo criado com sucesso', 'icon' => 'success']);
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Adicionou um novo estilo do tipo " . Estilo::find($estilo->id)->tipo . " no valor de " . number_format($this->preco, 2, ',', '.') . " kz</b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
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
