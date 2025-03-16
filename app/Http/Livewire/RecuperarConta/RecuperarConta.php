<?php

namespace App\Http\Livewire\RecuperarConta;

use App\Models\RecuperarConta\CodigoConfirmacao;
use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class RecuperarConta extends Component
{
    public $infoDispositivo, $email_telefone, $credenciais;
    public $habilitarNomeUtilizador = false, $habilitarCampoConfirmacao = false, $habilitarCampoPasse = false;
    public $codigoConfirmacao;
    public $passeNova, $passeConfirmacao;

    protected $messages = [
        'email_telefone.required' => 'O campo é obrigatório',
        'email_telefone.min' => 'O seu email ou telefone deve conter no mínimo 9 dígitos',
        'codigoConfirmacao.required' => 'O campo é obrigatório',
        'codigoConfirmacao.min' => 'O seu código deve conter no mínimo 4 dígitos',
        'codigoConfirmacao.max' => 'O seu código deve conter no máximo 4 dígitos',
        'passeNova.required' => 'O campo é obrigatório',
        'passeNova.min' => 'Digite uma senha com pelo menos 6 dígitos',
        'passeConfirmacao.required' => 'O campo é obrigatório',
        'passeConfirmacao.min' => 'Digite uma senha com pelo menos 6 dígitos',
    ];

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->route('pagina_inicial.');
        }
        $this->buscarDadosDispositivo();
    }

    public function render()
    {
        return view('livewire.recuperar-conta.recuperar-conta')
        ->layout("layouts.logado.app");
    }

    public function alterarPalavraPasse()
    {
        $this->validate([
            'passeNova' => 'required|min:6',
            'passeConfirmacao' => 'required|min:6',
        ]);
        $utilizador = User::find($this->credenciais->id);
        $this->actualizarPasse($utilizador, $this->passeNova, $this->passeConfirmacao);
    }

    public function actualizarPasse($utilizador, $passeNova, $passeConfirmacao)
    {
        if ($passeNova == $passeConfirmacao) {
            User::where('id', $utilizador->id)->update(['password' => Hash::make($passeNova)]);
            $this->emit('alerta', ['mensagem' => 'Palavra-passe alterada com sucesso', 'icon' => 'success']);
            $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> Alterou a palavra-passe </b> <hr>" . $this->infoDispositivo, "normal", $this->credenciais->id);
            $this->limparCampos();
        } else {
            $this->emit('alerta', ['mensagem' => 'Palavra-passe \'Nova\' e a de \'Confirmação\' devem ser as mesmas', 'icon' => 'warning', 'tempo' => 5500]);
        }
    }

    public function pesquisarEmailTelefone()
    {
        $this->validate([
            'email_telefone' => 'required|min:9',
        ]);
        $this->habilitarNomeUtilizador = false;
        $this->credenciais = $this->verificarLoginEmailTel($this->email_telefone);

        if ($this->credenciais) {
            $this->email_telefone = null;
            $this->habilitarNomeUtilizador = true;
        } else {
            $this->email_telefone = null;
            $this->limparCampos();
            $this->registrarTentativaRecuperacao($this->email_telefone);
            $this->emit('alerta', ['mensagem' => 'Erro, perfil não encontrado', 'icon' => 'error', 'tempo' => 4500]);
        }
    }

    public function confirmarCodigo()
    {
        $this->validate([
            'codigoConfirmacao' => 'required|min:4|max:4',
        ]);

        $confirmado = CodigoConfirmacao::where("user_id", $this->credenciais->id)
            ->where("codigo", $this->codigoConfirmacao)
            ->first();

        if ($confirmado) {
            $this->habilitarCampoPasse = true;
            $this->codigoConfirmacao = null;
            $this->habilitarCampoConfirmacao = false;
            CodigoConfirmacao::where("id", $confirmado->id)->delete();
        } else {
            $this->emit('alerta', ['mensagem' => 'Código errado', 'icon' => 'error', 'tempo' => 5500]);
            $this->habilitarCampoPasse = false;
        }
    }

    public function confirmarUtilizador()
    {
        $nomeRemente = $this->credenciais->name;
        $digitos = array(rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9));
        $dados = array(
            "digitos" => $digitos,
            "msg" => "Olá $nomeRemente o seu código de confirmação é este:",
            "assunto" => "Código de confirmação",
            "nome" => $this->credenciais->name,
            "email" => $this->credenciais->email,
        );

        $codigoUnico = $digitos[0] . $digitos[1] . $digitos[2] . $digitos[3];
        CodigoConfirmacao::create([
            'user_id' => $this->credenciais->id,
            'codigo' => $codigoUnico,
        ]);

        try {

            Mail::send('email.confirmar-recuperacao', $dados, function ($message) {
                $message->from('jeumsuporte@gmail.com', 'Jeum Suporte');
                $message->to($this->credenciais->email, $this->credenciais->name);
                $message->subject("Código de confirmação");
            });
            $this->habilitarCampoConfirmacao = true;
            $this->emit('alerta', ['mensagem' => 'Foi enviado um código de confirmação para o seu email', 'icon' => 'warning', 'tempo' => 5500]);
        } catch (\Throwable $th) {
            $this->emit('alerta', ['mensagem' => 'Mensagem não enviada, certifique a conexão de internet', 'icon' => 'error', 'tempo' => 6000]);
        }
    }

    public function verificarLoginEmailTel($email_telefone)
    {
        if (is_numeric($email_telefone)) {
            $utilizador = User::where("telefone", $email_telefone)->first();
            if ($utilizador) {
                return $utilizador;
            }
        } else {
            $utilizador = User::where("email", $email_telefone)->first();
            if ($utilizador) {
                return $utilizador;
            }
        }
    }

    public function registrarTentativaRecuperacao($email_telefone)
    {
        if (is_numeric($email_telefone)) {
            $utilizador = User::where("telefone", $email_telefone)->first();
            if ($utilizador) {
                $this->registrarActividade("<b class='text-danger'><i class='bi bi-info-circle-fill'></i> Houve uma tentativa de recuperação de conta no sistema com o seu número de telefone</b> <hr>" . $this->infoDispositivo, "alerta", $utilizador->id);
            }
        } else {
            $utilizador = User::where("email", $email_telefone)->first();
            if ($utilizador) {
                $this->registrarActividade("<b class='text-danger'><i class='bi bi-info-circle-fill'></i> Houve uma tentativa de recuperação de conta no sistema com o seu email</b> <hr>" . $this->infoDispositivo, "alerta", $utilizador->id);
            }
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

    public function limparCampos()
    {
        $this->codigoConfirmacao = null;
        $this->email_telefone = null;
        $this->habilitarNomeUtilizador = false;
        $this->habilitarCampoPasse = false;
        $this->habilitarCampoConfirmacao = false;
        $this->credenciais = array();
        $this->passeNova = null;
        $this->passeConfirmacao = null;
    }
}
