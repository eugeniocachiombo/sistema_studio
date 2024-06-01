<?php

namespace App\Http\Livewire\Chat;

use App\Models\chat\Conversa as ChatConversa;
use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use App\Models\Utilizador\RegistroActividade;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Livewire\Component;
use Livewire\WithFileUploads;

class Conversa extends Component
{
    use WithFileUploads;

    protected $todasConversas = array();
    public $habilitarUpload = false;
    public $arquivo = null;
    public $nomeArquivo, $extensaoArquivo, $tamanhoArquivo;
    public $extensoesAceites;
    public $utilizador_id, $remente, $estado, $idMensagem = null, $mensagem = null, $tipo_arquivo;
    public $caminhoArquivo = null, $tipoArquivo = null, $nomeOriginalArquivo = null, $extensaoOriginalArquivo = null;
    public $pagina_atual, $itens_por_pagina, $offset, $total_itens, $total_paginas;
    public $ocultarValidate = false, $btnEliminarMsg = false;
    public $placeholderMsg, $rowsMessagem;
    public $totalMsgActual, $novaMensagem;
    public $infoDispositivo;
    public $listeners = ['tempoRealMensagens'];

    protected $messages = [
        'mensagem.required' => 'Escreva a mensagem ou insira um arquivo',
    ];

    protected $rules = [
        'mensagem' => 'required',
    ];

    public function mount($utilizador, $remente)
    {
        $this->utilizador_id = $utilizador;
        $this->remente = $remente;
        $nomeUtilizador = $this->buscarNomeUsuario($this->utilizador_id);
        $nomeRemente = $this->buscarNomeUsuario($this->remente);
        
        $this->extensoesAceites = [
            "img" => ["jpg", "jpeg", "png"],
            "audio" => ["aac", "ogg", "m4a", "wav", "mp3"],
            "texto" => ["pdf", "doc", "txt"],
        ];
        $this->totalMsgActual = $this->listarMsgRecibidas();
        $this->buscarDadosDispositivo();
        $this->registrarActividade("<b><i class='bi bi-check-circle-fill text-success'></i> ".
        $nomeUtilizador . " Entrou em conversa com " . $nomeRemente .
        "</b> <hr>" . 
        $this->infoDispositivo, "normal", Auth::user()->id);
    }

    public function index($utilizador, $remente)
    {
        $utilizador = $utilizador;
        $remente = $remente;
        if ($utilizador == Auth::user()->id) {
            return view('index.chat.conversa', ["utilizador" => $utilizador, "remente" => $remente]);
        } else {
            return redirect()->to("/error");
        }
    }

    public function render()
    {
        $this->todasConversas = $this->listarTodasConversas();
        $this->ocutarMsgValidate();
        $this->setarDadosArquivo();
        $this->actualizarParaLidoMensagem();
        return view('livewire.chat.conversa', ["todasConversas", $this->todasConversas]);
    }

    public function msgPendentes()
    {
        return ChatConversa::where(function ($query) {
            $query->where('emissor', $this->utilizador_id)
                ->where('receptor', $this->remente)
                ->where('estado', 'pendente');
        })->orWhere(function ($query) {
                $query->where('receptor', $this->utilizador_id)
                    ->where('emissor', $this->remente)
                    ->where('estado', 'pendente');
        })->get();
    }

    public function ocutarMsgValidate()
    {
        if ($this->arquivo || $this->mensagem != null) {
            $this->ocultarValidate = true;
        }
    }

    public function tempoRealMensagens()
    {
        // Este método somente ajuda a carregar a página em tempo real
        // com a declaração em javascript no arquivo temporeal_msg.js
        // seu listener public $listeners = ['tempoRealMensagens'];
        // $this->actualizarParaLidoMensagem();
        $this->alertarNovaMsg();
        
    }

    public function alertarNovaMsg()
    {
        $this->novaMensagem = $this->listarMsgRecibidas();
        if (count($this->totalMsgActual) < count($this->novaMensagem)) {
            $this->emit('textoEmVoz', "Você tem nova mensagem");
            $this->emit('somReceberMensagem', asset('assets/toques_msg/audio2.mp3'));
            $this->totalMsgActual = $this->listarMsgRecibidas();
        }
    }

    public function listarMsgRecibidas()
    {
        return ChatConversa::where(function ($query) {
            $query->where('emissor', $this->remente)
                ->where('receptor', $this->utilizador_id);
        })->get();
    }

    public function listarTodasConversas()
    {
        $this->pagina_atual = 0;
        $this->itens_por_pagina = 5;
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : null;
        $this->pagina_atual =  $this->buscarPaginaActual($pagina);
        $this->offset = ($this->pagina_atual - 1) * $this->itens_por_pagina;
        $this->total_itens = 100;
        $this->total_paginas = ceil(count($this->totalMsgAmbosUtilizadores()) / 5);

        return DB::select('select * from conversas ' .
            ' where (emissor = ' . $this->utilizador_id . ' and receptor = ' . $this->remente .
            ' or ' .
            ' receptor = ' . $this->utilizador_id . ' and emissor = ' . $this->remente . ')' .
            ' order by id desc limit ' . $this->itens_por_pagina . ' offset ' . $this->offset);
    }

    public function buscarPaginaActual($pagina){
        if (isset($pagina)) {
            return $pagina;
        } else {
           return 1;
        }
    }

    public function totalMsgAmbosUtilizadores()
    {
        return DB::select('select * from conversas ' .
            ' where emissor = ' . $this->utilizador_id . ' and receptor = ' . $this->remente .
            ' or ' .
            ' receptor = ' . $this->utilizador_id . ' and emissor = ' . $this->remente . " and deleted_at IS NULL");
    }

    public function setarDadosArquivo()
    {
        if ($this->arquivo) {
            $this->nomeArquivo = $this->arquivo->getClientOriginalName();
            $this->extensaoArquivo = $this->arquivo->getClientOriginalExtension();
            $this->tamanhoArquivo = round($this->arquivo->getSize() / (1024 * 1024), 2) . " MB";
        }
    }

    public function habilitarInputFile()
    {
        if ($this->habilitarUpload == true) {
            $this->habilitarUpload = false;
            $this->ocultarValidate = true;
            $this->arquivo = null;
            $this->placeholderMsg = null;
            $this->rowsMessagem = null;
        } else {
            $this->habilitarUpload = true;
            $this->rowsMessagem = 1;
            $this->placeholderMsg = "Descrição do arquivo...";
        }
    }

    public function enviarMensagem()
    {
        $this->vereificarArquivoExiste();
    }

    public function vereificarArquivoExiste()
    {
        if ($this->arquivo) {
            $this->caminhoArquivo = $this->verificarExtensaoArquivo($this->extensaoArquivo);
            $this->verificarSeArquivoValido($this->caminhoArquivo);
        } else if ($this->mensagem != null) {
            $this->cadastrarMensagem();
        } else {
            $this->ocultarValidate = false;
            $this->validate();
        }
    }

    public function verificarSeArquivoValido($caminhoArquivo){
        if ($caminhoArquivo) {
            $this->tipoArquivo = $this->buscarTipoArquivo($this->extensaoArquivo);
            $this->extensaoOriginalArquivo = $this->extensaoArquivo;
            $this->nomeOriginalArquivo = $this->arquivo->getClientOriginalName();
            $this->cadastrarMensagem();
        } else {
            $this->emit('alerta', ['mensagem' => 'Arquivo inválido', 'icon' => 'warning']);
            $this->arquivo == null;
        }
    }

    public function cadastrarMensagem()
    {
        $dados = [
            "emissor" => $this->utilizador_id,
            "receptor" => $this->remente,
            "estado" => "pendente",
            "mensagem" => Crypt::encrypt($this->mensagem),
            "caminho_arquivo" => $this->caminhoArquivo ? $this->caminhoArquivo : "",
            "tipo_arquivo" => $this->tipoArquivo ? $this->tipoArquivo : "",
            "nome_arquivo" => $this->nomeOriginalArquivo ? $this->nomeOriginalArquivo : "",
            "extensao_arquivo" => $this->extensaoOriginalArquivo ? $this->extensaoOriginalArquivo : "",
            "deleted_at" => null,
        ];
        ChatConversa::create($dados);
        $this->limparCampos();
    }

    public function eliminarMensagem($id)
    {
        $verificarPrimeiroDel = ChatConversa::where("id", $id)
            ->select("primeiroDelete")->first();

        $verificarSegundoDel = ChatConversa::where("id", $id)
            ->select("segundoDelete")->first();

        if ($verificarPrimeiroDel->primeiroDelete == null) {
            ChatConversa::where("id", $id)
                ->update(["primeiroDelete" => $this->utilizador_id]);
        } elseif ($verificarSegundoDel->segundoDelete == null) {
            ChatConversa::where("id", $id)
                ->update([
                    "segundoDelete" => $this->utilizador_id,
                    "deleted_at" => Carbon::now(),
                ]);
        }
        $this->emit('alerta', ['mensagem' => 'Eliminado com sucesso', 'icon' => 'success']);
    }

    public function mensagemPressionada()
    {
        $this->mostrarBtnEliminarMsg();
    }

    public function actualizarParaLidoMensagem()
    {
        $msgPendentes = $this->msgPendentes();
        foreach ($msgPendentes as $item) {
            if ($item->receptor == $this->utilizador_id) {
                ChatConversa::where("id", $item->id)
                    ->update(['estado' => 'lido']);
            }
        }
    }

    public function mostrarBtnEliminarMsg()
    {
        if ($this->btnEliminarMsg == true) {
            $this->btnEliminarMsg = false;
        } else {
            $this->btnEliminarMsg = true;
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

    public function limparCampos()
    {
        $this->ocultarValidate = true;
        $this->arquivo = null;
        $this->mensagem = null;
        $this->habilitarUpload = false;
        $this->btnEliminarMsg = false;
        $this->mensagem = null;
        $this->caminhoArquivo = null;
        $this->tipoArquivo = null;
        $this->nomeOriginalArquivo = null;
        $this->extensaoOriginalArquivo = null;
        $this->placeholderMsg = null;
        $this->rowsMessagem = null;
    }

    public function buscarNomeUsuario($id)
    {
        return User::find($id)->name;
    }

    public function formatarData($data)
    {
        $data_hora = new DateTime($data);
        $agora = new DateTime('now');
        $diferenca = $data_hora->diff($agora)->days;
        if ($diferenca == 0) {
            $data_formatada = 'Hoje às ' . $data_hora->format('H:i');
        } elseif ($diferenca == 1) {
            $data_formatada = 'Ontem às ' . $data_hora->format('H:i');
        } elseif ($diferenca >= 2 && $diferenca <= 6) {
            $dias_semana = array(
                'Sunday' => 'Domingo',
                'Monday' => 'Segunda-feira',
                'Tuesday' => 'Terça-feira',
                'Wednesday' => 'Quarta-feira',
                'Thursday' => 'Quinta-feira',
                'Friday' => 'Sexta-feira',
                'Saturday' => 'Sábado',
            );
            $data_formatada = $data_hora->format('l \à\s H:i');
            $data_formatada = strtr($data_formatada, $dias_semana);
        } elseif ($diferenca >= 7) {
            $meses = array(
                'January' => 'Janeiro',
                'February' => 'Fevereiro',
                'March' => 'Março',
                'April' => 'Abril',
                'May' => 'Maio',
                'June' => 'Junho',
                'July' => 'Julho',
                'August' => 'Agosto',
                'September' => 'Setembro',
                'October' => 'Outubro',
                'November' => 'Novembro',
                'December' => 'Dezembro',
            );
            $data_formatada = $data_hora->format('d \d\e F \d\e Y \à\s H:i');
            $data_formatada = strtr($data_formatada, $meses);
        }
        return $data_formatada;
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

    public function registrarActividade($msg, $tipo, $user_id)
    {
        RegistroActividade::create([
            "mensagem" => $msg,
            "tipo_msg" => $tipo,
            "user_id" => $user_id,
        ]);
    }
}
