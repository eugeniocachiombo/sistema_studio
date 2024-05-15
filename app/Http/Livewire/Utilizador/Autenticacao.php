<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Autenticacao extends Component
{
    public $email_telefone;
    public $palavra_passe;
    public $lembre_me;
    public $infoDispositivo;

    protected $messages = [
        'email_telefone.required' => 'O campo é obrigatório',
        'email_telefone.min' => 'O seu email ou telefone deve conter no mínimo 9 dígitos',
        'palavra_passe.required' => 'O campo é obrigatório',
        'palavra_passe.min' => 'Digite uma senha com pelo menos 6 dígitos',
    ];

    protected $rules = [
        'email_telefone' => 'required|min:9',
        'palavra_passe' => 'required|min:6',
    ];

    public function mount()
    {
        $this->buscarDadosDispositivo();
    }

    public function index()
    {
        if (session('utilizador')) {
            return redirect()->route("pagina_inicial.");
        } else {
            return view('index.utilizador.autenticacao');
        }
    }

    public function render()
    {
        return view('livewire.utilizador.autenticacao');
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

    public function logar()
    {
        $this->validate();
        $user = User::where('email', $this->email_telefone)->first();
        $credenciais = $this->verificarLoginEmailTel($this->email_telefone, $this->palavra_passe);

        if (Auth::attempt($credenciais)) {
            $this->lembrarLogin();
            $this->limparCampos();
            $this->emit('alerta', ['mensagem' => 'Sucesso', 'icon' => 'success']);
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Autenticou-se no sistema</b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
            $this->emit('atrazar_redirect', ['caminho' => '/utilizador/preparar_ambiente', 'tempo' => 2500]);
            session()->put("utilizador", Auth::user()->name);
            session()->put("tipo_acesso", Auth::user()->tipo_acesso);
        } else {
            $this->registrarTentativaLogin($this->email_telefone);
            $this->emit('alerta', ['mensagem' => 'Erro, Dados inválidos', 'icon' => 'error']);
        }
    }

    public function verificarLoginEmailTel($email_telefone, $palavra_passe)
    {
        if (is_numeric($email_telefone)) {
            return [
                'telefone' => $email_telefone,
                'password' => $palavra_passe,
            ];
        } else {
            return [
                'email' => $email_telefone,
                'password' => $palavra_passe,
            ];
        }
    }

    public function registrarActividade($msg, $tipo, $user_id)
    {
        RegistroActividade::create([
            "mensagem" => $msg,
            "tipo_msg" => $tipo,
            "user_id" => $user_id,
        ]);
    }

    public function registrarTentativaLogin($email_telefone)
    {
        if (is_numeric($email_telefone)) {
            $utilizador = User::where("telefone", $email_telefone)->first();
            if ($utilizador) {
                $this->registrarActividade("<b class='text-danger'><i class='bi bi-info-circle-fill'></i> Houve uma tentativa de autenticação no sistema com o seu número de telefone</b> <hr>" . $this->infoDispositivo, "alerta", $utilizador->id);
            }
        } else {
            $utilizador = User::where("email", $email_telefone)->first();
            if ($utilizador) {
                $this->registrarActividade("<b class='text-danger'><i class='bi bi-info-circle-fill'></i> Houve uma tentativa de autenticação no sistema com o seu email</b> <hr>" . $this->infoDispositivo, "alerta", $utilizador->id);
            }
        }
    }

    public function lembrarLogin()
    {
        if ($this->lembre_me == true) {
            cookie("sessao_iniciada", true, time() * 365);
        }
    }

    public function limparCampos()
    {
        $this->email_telefone = null;
        $this->palavra_passe = null;
    }
}
