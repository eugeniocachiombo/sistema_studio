<?php

namespace App\Http\Livewire\Chat;

use App\Models\chat\Conversa as ChatConversa;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithFileUploads;

class Conversa extends Component
{
    use WithFileUploads;

    public $habilitarUpload = false;
    public $arquivo = null;
    public $nomeArquivo;
    public $extensaoArquivo;
    public $tamanhoArquivo;
    public $extensoesAceites = [
        "img" => ["jpg", "jpeg", "png"],
        "audio" => ["aac", "ogg", "m4a", "wav", "mp3"],
        "texto" => ["pdf", "doc", "txt"],
    ];
    public $utilizador_id, $remente, $estado, $mensagem = null, $tipo_arquivo;
    public $caminhoArquivo = null, $tipoArquivo = null, $nomeOriginalArquivo = null, $extensaoOriginalArquivo = null;
    protected $todasConversas = array();
    public $listeners = ['tempoRealMensagens'];

    protected $messages = [
        'mensagem.required' => 'Descreva a mensagem ou insira um arquivo',
    ];

    protected $rules = [
        'mensagem' => 'required',
    ];

    public function mount($utilizador, $remente)
    {
        $this->utilizador_id = $utilizador;
        $this->remente = $remente;
    }

    public function render()
    {
        $this->todasConversas = $this->listarTodasConversas();
        $this->setarDadosArquivo();
        return view('livewire.chat.conversa', ["todasConversas", $this->todasConversas]);
    }

    public function tempoRealMensagens()
    {
        $this->todasConversas = $this->listarTodasConversas();
    }

    public function listarTodasConversas()
    {
        return ChatConversa::where(function ($query) {
            $query->where("emissor", $this->utilizador_id)
                ->where("receptor", $this->remente);
        })
            ->orWhere(function ($query) {
                $query->where("receptor", $this->utilizador_id)
                    ->where("emissor", $this->remente);
            })
            ->orderBy('id', 'desc')
            ->simplePaginate(5);
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
            $this->arquivo = null;
        } else {
            $this->habilitarUpload = true;
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
            if ($this->caminhoArquivo) {
                $this->tipoArquivo = $this->buscarTipoArquivo($this->extensaoArquivo);
                $this->extensaoOriginalArquivo = $this->extensaoArquivo;
                $this->nomeOriginalArquivo = $this->arquivo->getClientOriginalName();
                $this->cadastrarMensagem();
            } else {
                $this->emit('alerta', ['mensagem' => 'Arquivo inválido', 'icon' => 'warning']);
                $this->arquivo == null;
                //return redirect()->route("chat.conversa", ["utilizador" => $this->utilizador_id, "remente" => $this->remente]);
            }
        } else if ($this->mensagem != null) {
            $this->cadastrarMensagem();
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
        ];
        ChatConversa::create($dados);
        $this->limparCampos();
        return redirect()->route("chat.conversa", ["utilizador" => $this->utilizador_id, "remente" => $this->remente]);
    }

    public function verificarExtensaoArquivo($extensaoArquivo)
    {
        $caminhoArquivo = "";
        foreach ($this->extensoesAceites as $chave => $extensao) {
            for ($i = 0; $i < count($extensao); $i++) {
                if ($extensao[$i] == $extensaoArquivo) {
                    $caminhoArquivo = $this->arquivo->store("uploads/" . $chave);
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
        $this->arquivo = null;
        $this->mensagem = null;
    }

    public function index($utilizador, $remente)
    {
        $utilizador = $utilizador;
        $remente = $remente;
        return view('index.chat.conversa', ["utilizador" => $utilizador, "remente" => $remente]);
    }
}
