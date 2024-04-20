@include('livewire.chat.inc.btnPaginacao') 

<div class="row gy-4">
    <div class="col d-table" style="margin-bottom: -20px">
        @php
            $ultimoEstado = "";
            $ultimaActualizacao = "";
        @endphp
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
                @php
                    $ultimoEstado = $item->estado;
                    $ultimaActualizacao = $item->updated_at;
                @endphp
            @endforeach
          
            @if ($ultimoEstado == 'lido' )
                 Visto: <i class="bi bi-check-circle-fill text-primary"></i> &nbsp; {{$this->formatarData($ultimaActualizacao)}}
                <hr>
            @endif
        @else
            <div class="col alert alert-danger text-center mb-5">
                
                <b class="d-table d-md-flex justify-content-center align-items-center " >
                    <div class="h3"><i class="bi bi-info-circle"></i> </div>
                    <div class="h5 ms-1 me-1">Não existe conversa com este utilizador</div> </b>
            </div>
        @endif
        @include('livewire.chat.inc.upload')
    </div>

   
