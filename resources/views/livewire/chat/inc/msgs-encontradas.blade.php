@foreach (array_reverse($this->todasConversas) as $item)
    <div class="col text-center pt-4">
        @if ($this->utilizador_id != $item->primeiroDelete && $this->utilizador_id != $item->segundoDelete)
            @if ($this->utilizador_id == $item->emissor)
                @include('livewire.chat.inc.msgUserLogado')
            @else
                @include('livewire.chat.inc.msgRemente')
            @endif
        @else
            <div class="col text-center alert alert-danger">
                <b class=""><i class="bi bi-info-circle"></i> Mensagem eliminada </b>
                <br> {{ $this->formatarData($item->updated_at) }}
            </div>
        @endif
    </div>

    @php
        $ultimoEstado = $item->estado;
        $ultimaActualizacao = $item->updated_at;
    @endphp
@endforeach

@include('livewire.chat.inc.verificacao-msg-lida')