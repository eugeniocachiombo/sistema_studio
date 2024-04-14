<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Autenticacao extends Component
{
    public $email;
    public $palavra_passe;
    public $lembre_me;

    protected $messages = [
        'email.required' => 'O campo é obrigatório',
        'email.email' => 'Formato de email inválido',
        'palavra_passe.required' => 'O campo é obrigatório',
    ];

    protected $rules = [
        'email' => 'required|email',
        'palavra_passe' => 'required|min:2',
    ];

    public function index()
    {
        if (session('utilizador')){
            return redirect()->route("pagina_inicial.");
        }else{
            return view('index.utilizador.autenticacao');
        }
    }

    public function render()
    {
        return view('livewire.utilizador.autenticacao');
    }

    public function logar()
    {
        $this->validate();
        $user = User::where('email', $this->email)->first();
        $credenciais = [
            'email' => $this->email,
            'password' => $this->palavra_passe,
        ];
        if (Auth::attempt($credenciais)) {
            $this->limparCampos();
            $this->emit('alerta', ['mensagem' => 'Sucesso', 'icon' => 'success']);
            $this->emit('atrazar_redirect', ['caminho' => '/utilizador/preparar_ambiente', 'tempo' => 2500]);
            session()->put("utilizador", Auth::user()->name);
        }else{
            $this->emit('alerta', ['mensagem' => 'Erro, Dados inválidos', 'icon' => 'error']);
        }
    }

    public function limparCampos()
    {
        $this->email = null;
        $this->palavra_passe = null;
    }
}
