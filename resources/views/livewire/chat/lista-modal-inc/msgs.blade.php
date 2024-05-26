@for ($i = 0; $i < count($this->listaParticipantes); $i++)
    @php
        $idRemente = $this->listaParticipantes[$i];
        $nome = $this->buscarNomeUsuario($idRemente);
        $conversa = $this->ultimaMensagem($idRemente);
    @endphp

    <div class="p-3" id="bgMsgGeral">
        @if ($conversa->estado == 'pendente' && $conversa->receptor == $utilizador_id)
            @include('livewire.chat.lista-modal-inc.enviado-pelo-logado')
        @else
            @include('livewire.chat.lista-modal-inc.enviado-pelo-remente')
        @endif
    </div>
    <hr>
@endfor
