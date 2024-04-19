<div class="container">
    <div class=" d-flex flex-column">
        <div class="col text-end">
            <span class="col ">
                <b>{{ $this->buscarNomeUsuario($item->emissor) }}</b>
            </span>
        </div>

        <div class=" col d-flex d-flex justify-content-end" {{-- wire:click.debounce.500ms='mensagemPressionada' --}}>
            @if ($item->caminho_arquivo != '' && $item->tipo_arquivo != '')
                <div class=" col-12 d-table ">
                    <div class="text-end">
                        @switch($item->tipo_arquivo)
                            @case('img')
                                <a href="{{ asset('assets/' . $item->caminho_arquivo) }}">
                                    <img src="{{ asset('assets/' . $item->caminho_arquivo) }}" alt="foto" width="40%">
                                </a>
                            @break

                            @case('audio')
                                
                                <audio class="col-12" controls>
                                    <source src="{{ asset('assets/' . $item->caminho_arquivo) }}" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>
                            @break

                            @case('texto')
                                <b>Arquivo:</b> <a
                                    href="{{ asset('assets/' . $item->caminho_arquivo) }}">{{ $item->nome_arquivo }}</a>
                                <br>
                            @break

                            @default
                        @endswitch
                    </div>

                    <div class="">
                        <div class="d-flex justify-content-end p-2">
                            <div class=" ps-2 col-12 d-flex justify-content-end align-items-center"
                                style="border-radius: 8px">
                                @if (Crypt::decrypt($item->mensagem))
                                    <b>Descrição: &nbsp; </b> {!! nl2br(Crypt::decrypt($item->mensagem)) !!} &nbsp;
                                @else
                                    <b>Descrição: &nbsp; </b> ------ &nbsp;
                                @endif
                            </div>


                            <div class="col text-end">
                                <button class="btn btn-danger "
                                    wire:click.prevent='eliminarMensagem({{ $item->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="d-flex align-items-center ">
                    <button class="btn btn-danger " wire:click.prevent='eliminarMensagem({{ $item->id }})'>
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div> &nbsp; &nbsp;

                @if (strlen(Crypt::decrypt($item->mensagem)) > 20)
                    <div class=" bg-dark text-light p-3 text-start" style="border-radius: 20px; max-width: 300px;">
                        {!! nl2br(Crypt::decrypt($item->mensagem)) !!}
                    </div>
                @else
                    <div class=" bg-dark text-light p-3 text-center" style="border-radius: 20px; min-width: 150px;">
                        {!! nl2br(Crypt::decrypt($item->mensagem)) !!}
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex justify-content-end " style="font-size: 14px">
            Enviado: {{ $this->formatarData($item->created_at) }}
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
