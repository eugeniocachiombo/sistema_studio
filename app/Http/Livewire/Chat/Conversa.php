<?php

namespace App\Http\Livewire\Chat;

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
        "texto" => ["pdf", "doc", "txt"]
    ];
    public $mensagem;

    public function render()
    {
        $this->setarDadosArquivo();
        return view('livewire.chat.conversa');
    }

    public function setarDadosArquivo(){
        if($this->arquivo){
            $this->nomeArquivo = $this->arquivo->getClientOriginalName();
            $this->extensaoArquivo = $this->arquivo->getClientOriginalExtension();
            $this->tamanhoArquivo = round($this->arquivo->getSize() / (1024 * 1024), 2) . " MB";
        }
    }

    public function habilitarInputFile(){
        if($this->habilitarUpload == true){
            $this->habilitarUpload = false;
            $this->arquivo = null;
        }else{
            $this->habilitarUpload = true;
        }
    }

    public function enviarMensagem(){
        if($this->arquivo){
            $caminhoArquivo = $this->verificarExtensaoArquivo($this->extensaoArquivo);
            if($caminhoArquivo){
                $tipoArquivo = $this->buscarTipoArquivo($this->extensaoArquivo);
                dd("Arquivo enviado: " . $caminhoArquivo . " Tipo de arquivo: " . $tipoArquivo);
                $this->arquivo = null;
            }else{
                $this->arquivo = null;
                $this->emit('alerta', ['mensagem' => 'Arquivo inválido', 'icon' => 'warning']);
            }
        }
    }

    public function verificarExtensaoArquivo($extensaoArquivo){
        $caminhoArquivo = "";
        foreach ($this->extensoesAceites as $chave => $extensao) {
            for ($i=0; $i < count($extensao); $i++) { 
                if($extensao[$i] == $extensaoArquivo){
                    $caminhoArquivo = $this->arquivo->store("uploads/" . $chave);
                    break;
                }
            }
        }
        return $caminhoArquivo;
    }

    public function buscarTipoArquivo($extensaoArquivo){
        $tipo = "";
        foreach ($this->extensoesAceites as $chave => $extensao) {
            for ($i=0; $i < count($extensao); $i++) { 
                if($extensao[$i] == $extensaoArquivo){
                    $tipo = $chave;
                    break;
                }
            }
        }
        return $tipo;
    }

    public function index()
    {
        return view('index.chat.conversa');
    }
}
