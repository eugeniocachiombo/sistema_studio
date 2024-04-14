<div class="row gy-4">
    <div class="col d-table">
        @if (count($this->todasConversas) > 0)
            @foreach (array_reverse($this->todasConversas) as $item)
                <div class="col text-center pt-4">
                    @if ($this->utilizador_id == $item->emissor)
                        @include('livewire.chat.inc.msgUserLogado')
                    @else
                        @include('livewire.chat.inc.msgRemente')
                    @endif
                </div>
            @endforeach
        @else
            <div class="col text-center pt-5 pb-2 mb-5">
                <b class="alert alert-danger"><i class="bi bi-info-circle"></i> Não existe conversa com este utilizador</b>
            </div>
        @endif

        @include('livewire.chat.inc.upload')
    </div>

    @include('livewire.chat.inc.btnPaginacao') 
