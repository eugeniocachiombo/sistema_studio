<?php

namespace App\Http\Livewire\Utilizador;

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
        return view('index.utilizador.autenticacao');
    }

    public function render()
    {
        return view('livewire.utilizador.autenticacao');
    }

    public function logar()
    {
        $this->validate();
        $this->emit('alerta', ['mensagem' => 'Sucesso', 'icon' => 'success']);
        $this->limparCampos();
        session()->put("utilizador", "Eugenio Cachiombo");
        return redirect("/pagina_inicial");
    }

    public function limparCampos()
    {
        $this->email = null;
        $this->palavra_passe = null;
    }
}
