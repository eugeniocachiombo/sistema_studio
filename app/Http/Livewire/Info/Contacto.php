<?php

namespace App\Http\Livewire\Info;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contacto extends Component
{
    public $nome;
    public $email;
    public $assunto;
    public $mensagem;

    protected $messages = [
        'email.required' => 'Campo obrigatório',
        'email.email' => 'Formato de email inválido',
        'nome.required' => 'Campo obrigatório',
        'mensagem.required' => 'Campo obrigatório',
        'assunto.required' => 'Campo obrigatório',
    ];

    protected $rules = [
        'email' => 'required|email',
        'nome' => 'required',
        'mensagem' => 'required',
        'assunto' => 'required',
    ];

    public function render()
    {
        return view('livewire.info.contacto');
    }

    public function enviarEmail()
    {
        $this->validate();
        Mail::send('email.email', ["msg" => $this->mensagem, "email" => $this->email], function ($message) {
            $message->from($this->email, $this->nome);
            $message->to('eugeniocachiombo@gmail.com', 'Eugénio Cachiombo');
            $message->subject($this->assunto);
        });
        $this->emit('alerta', ['mensagem' => 'Mensagem enviada', 'icon' => 'success']);
        $this->limparCampos();
    }

    public function limparCampos()
    {
        $this->email = null;
        $this->nome = null;
        $this->assunto = null;
        $this->mensagem = null;
    }

    public function index()
    {
        return view('index.info.contacto');
    }
}
