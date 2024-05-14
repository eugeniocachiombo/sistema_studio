<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use App\Models\Utilizador\Pessoa;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Cadastro extends Component
{
    public $nome, $sobrenome, $email, $nomeArtistico, $telefone, $passe, $nascimento, $genero, $aceitarTermos;
    public $infoDispositivo;

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

    public function mount()
    {
        $this->buscarDadosDispositivo();
    }

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

    public function cadastrar()
    {
        $this->validate();

        $dadosUser = [
            'name' => $this->nomeArtistico,
            'email' => $this->email,
            'email_verified_at' => now(),
            'telefone' => $this->telefone,
            'password' => Hash::make($this->passe),
            'tipo_acesso' => 3,
            'remember_token' => Str::random(10),
        ];
        $user = User::create($dadosUser);

        $dadosPessoa = [
            "nome" => $this->nome,
            "sobrenome" => $this->sobrenome,
            "genero" => $this->genero,
            "nascimento" => $this->nascimento,
            "user_id" => $user->id,
        ];
        $pessoa = Pessoa::create($dadosPessoa);
        $this->msgRegistroActividades($pessoa, $user);
        $this->emit('alerta', ['mensagem' => 'Conta criada com sucesso', 'icon' => 'success']);
        $this->emit('atrazar_redirect', ['caminho' => '/utilizador/autenticacao', 'tempo' => 2500]);
    }

    public function msgRegistroActividades($pessoa, $user){
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Registrou-se no sistema </b> <hr>" . $this->infoDispositivo, "normal", $user->id);

        if ($pessoa->genero == "M") {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> <h3>Seja Bem-vindo $user->name </h3> </b> <hr>" . $this->infoDispositivo, "normal", $user->id);
        } else {
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> <h3>Seja Bem-vinda $user->name </h3> </b> <hr>" . $this->infoDispositivo, "normal", $user->id);
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
