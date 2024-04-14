<div class="row gy-4">
    <div class="col d-table" style="margin-bottom: -20px">
        @if (count($this->todasConversas) > 0)
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
                            <br> {{$this->formatarData($item->updated_at)}}
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="col text-center pt-5  mb-5">
                <b class="alert alert-danger"><i class="bi bi-info-circle"></i> Não existe conversa com este utilizador</b>
            </div>
        @endif
        @include('livewire.chat.inc.upload')
    </div>

    @include('livewire.chat.inc.btnPaginacao') 
