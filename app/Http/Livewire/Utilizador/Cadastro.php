<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use App\Models\Utilizador\Pessoa;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Rules\Letter;
use App\Rules\Number;

class Cadastro extends Component
{
    public $nome, $sobrenome, $email, $nomeArtistico, $telefone, $passe, $nascimento, $genero, $aceitarTermos;
    
    protected $rules = [
        'nome' => 'required|regex:/^[^0-9]*$/',
        'sobrenome' => 'required|regex:/^[^0-9]*$/',
        'nomeArtistico' => 'required',
        'email' => 'required|email',
        'telefone' => 'required|integer|digits:9', 
        'passe' => 'required|min:6',
        'nascimento' => 'required',
        'genero' => 'required',
        'aceitarTermos' => 'required',
    ];

    protected $messages = [
        'nome.required' => 'Campo obrigatório',
        'nome.regex' => 'O seu nome não deve conter números',
    
        'sobrenome.required' => 'Campo obrigatório',
        'sobrenome.regex' => 'O seu sobrenome não deve conter números',
    
        'nomeArtistico.required' => 'Campo obrigatório',
    
        'email.required' => 'Campo obrigatório',
        'email.email' => 'O campo deve conter um endereço de e-mail válido',
    
        'telefone.required' => 'Campo obrigatório',
        'telefone.digits' => 'O seu telefone deve conter apenas 9 dígitos',
        'telefone.integer' => 'O seu telefone deve conter apenas números',
    
        'passe.required' => 'Campo obrigatório',
        'passe.min' => 'Digite uma senha com pelo menos 6 caracteres',
    
        'nascimento.required' => 'Campo obrigatório',
        'genero.required' => 'O gênero é obrigatório',
        'aceitarTermos.required' => 'Você deve concordar com as políticas',
    ];

    public function index()
    {
        if (session('utilizador')) {
            return redirect()->route("pagina_inicial.");
        } else {
            return view('index.utilizador.cadastro');
        }
    }

    public function render()
    {
        return view('livewire.utilizador.cadastro');
    }

    public function cadastrar(){
        $this->validate();

        $dadosUser = [
            'name' => $this->nomeArtistico,
            'email' => $this->email,
            'email_verified_at' => now(), 
            'password' => Hash::make($this->passe), 
            'tipo_acesso' => 3,
            'remember_token' => Str::random(10)
        ];
        $user = User::create($dadosUser);

        $dadosPessoa = [
            "nome" => $this->nome,
            "sobrenome" => $this->sobrenome,
            "genero" => $this->genero,
            "nascimento" => $this->nascimento,
            "user_id" => $user->id
        ];
        $pessoa = Pessoa::create($dadosPessoa);

        dd($user, $pessoa);
    }
}
