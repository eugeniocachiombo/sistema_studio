<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\Acesso\Acesso;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use App\Models\Utilizador\Pessoa;
use App\Models\Utilizador\RegistroActividade;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Livewire\Component;
use Livewire\WithFileUploads;

class Perfil extends Component
{
    use WithFileUploads;

    public $utilizador_id;
    public $arquivo = null;
    public $nomeArquivo, $extensaoArquivo, $tamanhoArquivo;
    public $extensoesAceites = [
        "img" => ["jpg", "jpeg", "png"],
    ];
    public $caminhoArquivo = null, $tipoArquivo = null, $nomeOriginalArquivo = null, $extensaoOriginalArquivo = null;
    public $passeActual = null, $passeNova = null, $passeConfirmacao = null;

    public $nome = null, $sobrenome = null, $sobre = null, $nomeArtistico = null, $genero = null, $nascimento = null, $telefone = null,
    $email = null, $nacionalidade = null, $provincia = null, $municipio = null, $endereco = null,
    $twitter = null, $facebook = null, $instagram = null, $linkedin = null;

    public $tabVisaoGeral, $tabConteudoVisaoGeral;
    public $tabEditarPerfil, $tabConteudoEditarPerfil;
    public $tabEditarPasse, $tabConteudoEditarPasse;
    public $infoDispositivo;

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

        'nascimento.required' => 'Campo obrigatório',
        'nascimento.after_or_equal' => 'Data de nascimento inválido',

        'genero.required' => 'O gênero é obrigatório',

        'passeActual.required' => 'O campo é obrigatório',
        'passeActual.min' => 'Digite uma senha com pelo menos 6 dígitos',
        'passeNova.required' => 'O campo é obrigatório',
        'passeNova.min' => 'Digite uma senha com pelo menos 6 dígitos',
        'passeConfirmacao.required' => 'O campo é obrigatório',
        'passeConfirmacao.min' => 'Digite uma senha com pelo menos 6 dígitos',
    ];

    public function mount()
    {
        $this->tabVisaoGeral = "active";
        $this->tabConteudoVisaoGeral = "show active";
        $this->utilizador_id = Auth::user()->id;
        $this->setarDadosInicialmente();
        $this->buscarDadosDispositivo();
    }

    public function index()
    {
        return view('index.utilizador.perfil');
    }

    public function render()
    {
        $this->setarDadosArquivo();
        return view('livewire.utilizador.perfil');
    }

    public function updated(){
        if($this->passeActual != null || $this->passeNova != null || $this->passeConfirmacao != null){
            $this->tabEditarPerfil = "";
            $this->tabConteudoEditarPerfil = "";
            $this->tabVisaoGeral = "";
            $this->tabConteudoVisaoGeral = "";
            $this->tabEditarPasse = "active";
            $this->tabConteudoEditarPasse = "show active"; 
        } else if (
            $this->passeActual == null && $this->passeNova == null && $this->passeConfirmacao == null &&
            $this->nome != null || $this->sobrenome != null || $this->sobre != null || $this->nomeArtistico != null ||
            $this->genero != null || $this->nascimento != null || $this->telefone != null ||
            $this->email != null || $this->nacionalidade != null || $this->provincia != null || $this->endereco != null ||
            $this->twitter != null || $this->facebook != null || $this->instagram != null || $this->linkedin != null 
            ) {
            $this->tabEditarPerfil = "active";
            $this->tabConteudoEditarPerfil = "show active";
            $this->tabVisaoGeral = "";
            $this->tabConteudoVisaoGeral = "";
            $this->tabEditarPasse = "";
            $this->tabConteudoEditarPasse = ""; 
        } 
    }

    public function setarDadosInicialmente()
    {
        $utilizador = $this->buscarDadosUtilizador($this->utilizador_id);
        $dadosPessoais = $this->buscarDadosPessoais($utilizador->id);
        $acesso = $this->buscarTipoAcesso($utilizador->tipo_acesso);
        $nascimento = $this->buscarNascimento($dadosPessoais->nascimento);

        $this->nome = ucwords($dadosPessoais->nome);
        $this->sobrenome = ucwords($dadosPessoais->sobrenome);
        $this->sobre = $dadosPessoais->sobre != null ? $dadosPessoais->sobre : '';
        $this->nomeArtistico = ucwords($utilizador->name);
        $this->genero = $dadosPessoais->genero;
        $this->nascimento = $dadosPessoais->nascimento;
        $this->telefone = $utilizador->telefone;
        $this->email = $utilizador->email;
        $this->nacionalidade = $dadosPessoais->nacionalidade != null ? ucwords($dadosPessoais->nacionalidade) : '';
        $this->provincia = $dadosPessoais->provincia != null ? ucwords($dadosPessoais->provincia) : '';
        $this->municipio = $dadosPessoais->municipio != null ? ucwords($dadosPessoais->municipio) : '';
        $this->endereco = $dadosPessoais->endereco != null ? ucwords($dadosPessoais->endereco) : '';
        $this->twitter = $dadosPessoais->twitter != null ? $dadosPessoais->twitter : 'https://twitter.com/#';
        $this->facebook = $dadosPessoais->facebook != null ? $dadosPessoais->facebook : 'https://facebook.com/#';
        $this->instagram = $dadosPessoais->instagram != null ? $dadosPessoais->instagram : 'https://instagram.com/#';
        $this->linkedin = $dadosPessoais->linkedin != null ? $dadosPessoais->linkedin : 'https://linkedin.com/#';
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarDadosPessoais($idUtilizador)
    {
        return Pessoa::where("user_id", $idUtilizador)->first();
    }

    public function buscarTipoAcesso($id)
    {
        return Acesso::find($id);
    }

    public function setarDadosArquivo()
    {
        if ($this->arquivo) {
            $this->nomeArquivo = $this->arquivo->getClientOriginalName();
            $this->extensaoArquivo = $this->arquivo->getClientOriginalExtension();
            $this->tamanhoArquivo = round($this->arquivo->getSize() / (1024 * 1024), 2) . " MB";
            $this->vereificarArquivoExiste();
        }
    }

    public function vereificarArquivoExiste()
    {
        if ($this->arquivo) {
            $this->caminhoArquivo = $this->verificarExtensaoArquivo($this->extensaoArquivo);
            if ($this->caminhoArquivo) {
                $this->tipoArquivo = $this->buscarTipoArquivo($this->extensaoArquivo);
                $this->extensaoOriginalArquivo = $this->extensaoArquivo;
                $this->nomeOriginalArquivo = $this->arquivo->getClientOriginalName();
                $this->cadastrarFotoPerfil();
            } else {
                $this->emit('alerta', ['mensagem' => 'Arquivo inválido', 'icon' => 'warning']);
                $this->limparCampos();
            }
        }
    }

    public function verificarExtensaoArquivo($extensaoArquivo)
    {
        $caminhoArquivo = "";
        foreach ($this->extensoesAceites as $chave => $extensao) {
            for ($i = 0; $i < count($extensao); $i++) {
                if ($extensao[$i] == $extensaoArquivo) {
                    $caminhoArquivo = $this->arquivo->store("uploads/" . $chave, "local");
                    break;
                }
            }
        }
        return $caminhoArquivo;
    }

    public function buscarTipoArquivo($extensaoArquivo)
    {
        $tipo = "";
        foreach ($this->extensoesAceites as $chave => $extensao) {
            for ($i = 0; $i < count($extensao); $i++) {
                if ($extensao[$i] == $extensaoArquivo) {
                    $tipo = $chave;
                    break;
                }
            }
        }
        return $tipo;
    }

    public function cadastrarFotoPerfil()
    {
        $dados = [
            "caminho_arquivo" => $this->caminhoArquivo ? $this->caminhoArquivo : "",
            "tipo_arquivo" => $this->tipoArquivo ? $this->tipoArquivo : "",
            "nome_arquivo" => $this->nomeOriginalArquivo ? $this->nomeOriginalArquivo : "",
            "extensao_arquivo" => $this->extensaoOriginalArquivo ? $this->extensaoOriginalArquivo : "",
            "user_id" => $this->utilizador_id,
            "deleted_at" => null,
        ];
        $foto = FotoPerfil::where("user_id", $this->utilizador_id)->first();
        $this->inserirFoto($foto, $dados);
        $this->limparCampos();
    }

    public function inserirFoto($foto, $dados)
    {
        if ($foto) {
            FotoPerfil::where("id", $foto->id)->update($dados);
            $this->emit('alerta', ['mensagem' => 'Foto actualizada com sucesso', 'icon' => 'success']);
        } else {
            FotoPerfil::create($dados);
            $this->emit('alerta', ['mensagem' => 'Foto inserida com sucesso', 'icon' => 'success']);
        }
    }

    public function buscarFotoPerfil($idUtilizador)
    {
        $foto = FotoPerfil::where("user_id", $idUtilizador)->orderby("id", "desc")->first();
        if ($foto) {
            $caminho = public_path('assets/' . $foto->caminho_arquivo);
            if (file_exists($caminho)) {
                return $foto;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function clickBtnEliminarFoto($idUtilizador)
    {
        $foto = FotoPerfil::where("user_id", $idUtilizador)->orderby("id", "desc")->first();
        if ($foto) {
            $caminho = public_path('assets/' . $foto->caminho_arquivo);
            if (file_exists($caminho)) {
                $this->eliminarFotoPerfil();
            } else {
                $this->emit('alerta', ['mensagem' => 'Requer uma foto no perfil', 'icon' => 'error']);
            }
        } else {
            $this->emit('alerta', ['mensagem' => 'Requer uma foto no perfil', 'icon' => 'error']);
        }
    }

    public function eliminarFotoPerfil()
    {
        FotoPerfil::where("user_id", $this->utilizador_id)->delete();
        $this->emit('alerta', ['mensagem' => 'Foto eliminada com sucesso', 'icon' => 'success']);
    }

    public function alterarPalavraPasse()
    {
        $this->validate([
            'passeActual' => 'required|min:6',
            'passeNova' => 'required|min:6',
            'passeConfirmacao' => 'required|min:6',
        ]);
        $utilizador = Auth::user();
        session()->put("alterarPasse", true);
        $this->actualizarPasse($utilizador, $this->passeActual, $this->passeNova, $this->passeConfirmacao);
    }

    public function actualizarPasse($utilizador, $passeActual, $passeNova, $passeConfirmacao)
    {
        if (Hash::check($passeActual, $utilizador->password)) {
            if ($passeNova == $passeActual) {
                $this->emit('alerta', ['mensagem' => 'Palavra-passe \'Nova\' deve ser diferente da \'Antiga\'', 'icon' => 'error', 'tempo' => 4500]);
            } else if ($passeNova == $passeConfirmacao) {
                User::where('id', $utilizador->id)->update(['password' => Hash::make($passeNova)]);
                $this->emit('alerta', ['mensagem' => 'Palavra-passe alterada com sucesso', 'icon' => 'success']);
                $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Alterou a palavra-passe </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
                $this->limparCampos();
            } else {
                $this->emit('alerta', ['mensagem' => 'Palavra-passe \'Nova\' e a de \'Confirmação\' devem ser as mesmas', 'icon' => 'warning', 'tempo' => 5000]);
            }
        } else {
            $this->emit('alerta', ['mensagem' => 'Palavra-passe actual está errada', 'icon' => 'error', 'tempo' => 4500]);
        }
    }

    public function actualizarDadosPerfil()
    {
        $this->validate([
            'nome' => 'required|regex:/^[^0-9]*$/',
            'sobrenome' => 'required|regex:/^[^0-9]*$/',
            'nomeArtistico' => 'required',
            'email' => 'required|email',
            'telefone' => 'required|integer|digits:9',
            'nascimento' => 'required|date|after_or_equal:1960-04-01',
            'genero' => 'required',
        ]);

        $dadosUser = [
            'name' => $this->nomeArtistico,
            'email' => $this->email,
            'telefone' => $this->telefone,
        ];

        User::where('id', $this->utilizador_id)->update($dadosUser);

        $dadosPessoa = [
            "nome" => $this->nome,
            "sobrenome" => $this->sobrenome,
            "sobre" => $this->sobre,
            "genero" => $this->genero,
            "nascimento" => $this->nascimento,
            "nacionalidade" => $this->nacionalidade,
            "user_id" => $this->utilizador_id,
            "provincia" => $this->provincia,
            "municipio" => $this->municipio,
            "endereco" => $this->endereco,
            "twitter" => $this->twitter,
            "facebook" => $this->facebook,
            "instagram" => $this->instagram,
            "linkedin" => $this->linkedin,
        ];
        Pessoa::where('user_id', $this->utilizador_id)->update($dadosPessoa);
        $this->emit('alerta', ['mensagem' => 'Dados actualizados com sucesso', 'icon' => 'success']);
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Actualizou seus dados </b> <hr>" . $this->infoDispositivo, "normal", Auth::user()->id);
    }

    public function buscarNascimento($data)
    {
        $meses = array(
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        );
    
        $data_objeto = new DateTime($data);
        $dia = $data_objeto->format('d');
        $mes_num = $data_objeto->format('m');
        $mes = $meses[$mes_num];
        $ano = $data_objeto->format('Y');
        
        $data_formatada = "$dia de $mes de $ano";
        $data_formatada = mb_convert_case($data_formatada, MB_CASE_TITLE, "UTF-8");
        return $data_formatada;
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
        $this->passeActual = null;
        $this->passeNova = null;
        $this->passeConfirmacao = null;
        $this->tipoArquivo = null;
        $this->nomeArquivo = null;
        $this->extensaoOriginalArquivo = null;
        $this->nomeOriginalArquivo = null;
        $this->arquivo = null;
        $this->caminhoArquivo = null;
        $this->tipoArquivo = null;
        $this->nomeOriginalArquivo = null;
        $this->extensaoOriginalArquivo = null;
    }
}
