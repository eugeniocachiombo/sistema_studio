@include('livewire.chat.inc.btnPaginacao')
<div class="row gy-4">
    @php
        $ultimoEstado = '';
        $ultimaActualizacao = '';
    @endphp

    <div class="col d-table" style="margin-bottom: -20px">
        @if (count($this->todasConversas) > 0)
            @include('livewire.chat.inc.msgs-encontradas')
            @include('livewire.chat.inc.verificacao-msg-lida')
        @else
            <div class="col alert alert-danger text-center mb-5">
                <b class="d-table d-md-flex justify-content-center align-items-center ">
                    <div class="h3"><i class="bi bi-info-circle"></i> </div>
                    <div class="h5 ms-1 me-1">Não existe conversa com este utilizador</div>
                </b>
            </div>
        @endif
        @include('livewire.chat.inc.upload')
    </div>
</div>
