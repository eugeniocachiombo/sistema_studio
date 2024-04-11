<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use Livewire\WithFileUploads;

class Conversa extends Component
{
    use WithFileUploads;
    public $habilitarUpload = false;
    public $arquivo;

    public function render()
    {
        return view('livewire.chat.conversa');
    }

    public function habilitarInputFile(){
        if($this->habilitarUpload == true){
            $this->habilitarUpload = false;
        }else{
            $this->habilitarUpload = true;
        }
    }

    public function enviarMensagem(){
    }

    public function index()
    {
        return view('index.chat.conversa');
    }
}
