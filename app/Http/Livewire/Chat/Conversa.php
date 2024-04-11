<?php

namespace App\Http\Livewire\Chat;

use App\Models\chat\Conversa as ChatConversa;
use Livewire\Component;
use Livewire\WithFileUploads;

class Conversa extends Component
{
    use WithFileUploads;

    public $habilitarUpload = false;
    public $arquivo;
    public $nomeArquivo;
    public $extensaoArquivo;
    public $tamanhoArquivo;
    public $extensoesAceites = [
        "img" => ["jpg", "jpeg", "png"],
        "audio" => ["aac", "ogg", "m4a", "wav", "mp3"],
        "texto" => ["pdf", "doc", "txt"],
    ];
    public $utilizador_id = null;
    public $remente = null;
    public $estado = null;
    public $mensagem = null;
    public $tipo_arquivo = null;
    protected $todasConversas = array();

    public function mount()
    {
        $this->utilizador_id = 1;
        $this->remente = 2;
    }

    public function render()
    {
        $this->todasConversas = ChatConversa::where(function ($query) {
            $query->where("emissor", $this->utilizador_id)
                ->where("receptor", $this->remente);
        })
            ->orWhere(function ($query) {
                $query->where("receptor", $this->utilizador_id)
                    ->where("emissor", $this->remente);
            })
            ->orderBy('id', 'desc')
            ->simplePaginate(5);
        $this->setarDadosArquivo();
        return view('livewire.chat.conversa', ["todasConversas", $this->todasConversas]);
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
        $dados = ChatConversa::create([
            "emissor" => $this->utilizador_id,
            "receptor" => $this->remente,
            "estado" => "lido",
            "mensagem" => $this->mensagem,
            "caminho_arquivo" => "",
            "tipo_arquivo" => ""
        ]);

        if ($this->arquivo) {
            $caminhoArquivo = $this->verificarExtensaoArquivo($this->extensaoArquivo);
            if ($caminhoArquivo) {
                $tipoArquivo = $this->buscarTipoArquivo($this->extensaoArquivo);
                dd("Arquivo enviado: " . $caminhoArquivo . " Tipo de arquivo: " . $tipoArquivo);
                $this->arquivo = null;
            } else {
                $this->arquivo = null;
                $this->emit('alerta', ['mensagem' => 'Arquivo inválido', 'icon' => 'warning']);
            }

            $this->limparCampos();
        }
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

    public function limparCampos(){
        $this->arquivo = null;
        $this->mensagem = null;
    }

    public function index()
    {
        return view('index.chat.conversa');
    }
}
