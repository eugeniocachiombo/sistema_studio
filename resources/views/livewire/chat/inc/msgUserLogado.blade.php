<div class="container">
    <div class=" d-flex flex-column">
        <div class="col text-end">
            <span class="col ">
                <b>{{ $this->buscarNomeUsuario($item->emissor) }}</b>
            </span>
        </div>

        <div class="col d-flex justify-content-end" {{--wire:click.debounce.500ms='mensagemPressionada'--}} >
            {{--@if ($this->btnEliminarMsg == true)--}}
                <div class=" d-flex align-items-center me-2">
                    <button class="btn btn-danger "
                        wire:click.prevent='eliminarMensagem({{ $item->id }})'>
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            {{--@endif--}}

            @if ($item->caminho_arquivo != '' && $item->tipo_arquivo != '')
                <div class=" col-6 p-3">
                    @switch($item->tipo_arquivo)
                        @case('img')
                            <a href="{{ url('storage/' . $item->caminho_arquivo) }}">
                                <img src="{{ url('storage/' . $item->caminho_arquivo) }}" alt="foto"
                                    width="100%">
                            </a>
                        @break

                        @case('audio')
                            <audio controls>
                                <source src="{{ url('storage/' . $item->caminho_arquivo) }}"
                                    type="audio/mpeg">
                                Your browser does not support the audio
                                element.
                            </audio>
                        @break

                        @case('texto')
                            <a
                                href="{{ url('storage/' . $item->caminho_arquivo) }}">{{ $item->nome_arquivo }}</a>
                            <br>
                        @break

                        @default
                    @endswitch
                    {!! nl2br(Crypt::decrypt($item->mensagem)) !!}
                </div>
            @else
                @if (strlen(Crypt::decrypt($item->mensagem)) > 20)
                    <div class=" bg-dark text-light p-3 text-start" style="border-radius: 5%;">
                        {!! nl2br(Crypt::decrypt($item->mensagem)) !!}
                    </div>
                @else
                    <div class=" bg-dark text-light p-3 text-center"
                        style="border-radius: 5%; min-width: 150px;">
                        {!! nl2br(Crypt::decrypt($item->mensagem)) !!}
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex justify-content-end " style="font-size: 14px">
            Enviado: {{ $item->created_at }}
        </div>
        <hr
            style="
            opacity: 0.08;
            border: none;
        height: 3px;
        background-color: #FF5733;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);">
    </div>
</div>