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
                dd($caminhoArquivo);
            }else{
                $this->arquivo = null;
                $this->emit('alerta', ['mensagem' => 'Arquivo inválido', 'icon' => 'warning']);
            }
        }
    }

    public function verificarExtensaoArquivo($extensaoArquivo){
        $caminhoArquivo = "";
        switch ($this->extensaoArquivo) {
            case 'jpg': 
                $caminhoArquivo = $this->arquivo->store("uploads/img");
                break;

            case 'jpeg': 
                $caminhoArquivo = $this->arquivo->store("uploads/img");
                break;

            case 'png':
                $caminhoArquivo = $this->arquivo->store("uploads/img");
                break;

            case 'aac': 
                $caminhoArquivo = $this->arquivo->store("uploads/audio");
                break;

            case 'ogg': 
                $caminhoArquivo = $this->arquivo->store("uploads/audio");
                break;
                
            case 'm4a': 
                $caminhoArquivo = $this->arquivo->store("uploads/audio");
                break;

            case 'wav': 
                $caminhoArquivo = $this->arquivo->store("uploads/audio");
                break;

            case 'mp3': 
                $caminhoArquivo = $this->arquivo->store("uploads/audio");
                break;

            case 'pdf':
                $caminhoArquivo = $this->arquivo->store("uploads/pdf");
                break;

            default:
                break;
        }
        return $caminhoArquivo;
    }

    public function index()
    {
        return view('index.chat.conversa');
    }
}
