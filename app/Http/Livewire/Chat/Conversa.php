<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;

class Conversa extends Component
{
    public function render()
    {
        return view('livewire.chat.conversa');
    }

    public function index()
    {
        return view('index.chat.conversa');
    }
}
