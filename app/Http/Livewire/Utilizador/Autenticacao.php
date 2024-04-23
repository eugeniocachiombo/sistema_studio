<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
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
            $this->lembrarLogin();
            $this->limparCampos();
            $this->emit('alerta', ['mensagem' => 'Sucesso', 'icon' => 'success']);
            $this->registrarActividade(" Autenticou-se no sistema", "normal", Auth::user()->id);
            $this->emit('atrazar_redirect', ['caminho' => '/utilizador/preparar_ambiente', 'tempo' => 2500]);
            session()->put("utilizador", Auth::user()->name);
        }else{
            $this->registrarTentativaLogin($this->email);
            $this->emit('alerta', ['mensagem' => 'Erro, Dados inválidos', 'icon' => 'error']);
        }
    }

    public function registrarActividade($msg, $tipo, $user_id){
        RegistroActividade::create( [
            "mensagem" => $msg,
            "tipo_msg" => $tipo,
            "user_id" => $user_id,
        ]);
    }

    public function registrarTentativaLogin($email){
        $utilizador = User::where("email", $email)->first();
        if($utilizador){
            $this->registrarActividade("Houve uma tentativa de autenticação no sistema com o seu email", "alerta", $utilizador->id);
        }
    }

    public function lembrarLogin(){
        if($this->lembre_me == true){
          cookie("sessao_iniciada", true, time()*365);
        }
    }

    public function limparCampos()
    {
        $this->email = null;
        $this->palavra_passe = null;
    }
}
