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
        return view('livewire.info.contacto')
        ->layout("layouts.logado.app");
    }

    public function enviarEmail()
    {
        $this->validate();
        $dados = [
            "msg" => $this->mensagem,
            "assunto" => $this->assunto,
            "nome" => $this->nome,
            "email" => $this->email
        ];
        try {
            Mail::send('email.view-do-email', $dados, function ($message) {
                $message->from($this->email, $this->nome);
                $message->to('jeumsuporte@gmail.com', 'Jeum Suporte');
                $message->subject($this->assunto);
            });
            $this->emit('alerta', ['mensagem' => 'Mensagem enviada', 'icon' => 'success']);
            $this->limparCampos();
        } catch (\Throwable $th) {
            $this->emit('alerta', ['mensagem' => 'Mensagem não enviada, certifique a conexão de internet', 'icon' => 'error', 'tempo' => 6000]);
        }
        
    }

    public function limparCampos()
    {
        $this->email = null;
        $this->nome = null;
        $this->assunto = null;
        $this->mensagem = null;
    }

    
}
