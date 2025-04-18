<div class="container">
    <div class=" d-flex flex-column">
        <div class="col text-start">
            <span class="col ">
                <b>{{ $this->buscarNomeUsuario($item->emissor) }}</b>
            </span>
        </div>

        <div class="col d-flex d-flex justify-content-start" {{-- wire:click.debounce.500ms='mensagemPressionada' --}}>
            @if ($item->caminho_arquivo != '' && $item->tipo_arquivo != '')
                <div class=" col-12 d-table ">
                    <div class="text-start">

                        @switch($item->tipo_arquivo)
                            @case('img')
                                <a href="{{ asset('assets/' . $item->caminho_arquivo) }}">
                                    <img src="{{ asset('assets/' . $item->caminho_arquivo) }}" alt="foto" width="40%">
                                </a>
                            @break

                            @case('audio')
                                <audio controls class="col-12">
                                    <source src="{{ asset('assets/' . $item->caminho_arquivo) }}" type="audio/mpeg">
                                        Seu navegador não suporta este reprodutor
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

                    <div class="" >
                        <div class="d-flex justify-content-start p-2">
                            <div class="col text-start">
                                <button class="btn btn-danger "
                                    wire:click.prevent='eliminarMensagem({{ $item->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>

                                <div class=" ps-2 col-12 d-flex justify-content-start align-items-center"
                                style="border-radius: 8px">
                                    @if (Crypt::decrypt($item->mensagem))
                                        <b>Descrição: &nbsp; </b> {!! nl2br(Crypt::decrypt($item->mensagem)) !!}
                                    @else 
                                        <b>Descrição: &nbsp; </b> ------
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            @else
            
                @if (strlen(Crypt::decrypt($item->mensagem)) > 20)
                    <div class=" bg-info text-light p-3 text-start" style="border-radius: 20px; max-width: 300px;">
                        {!! nl2br(Crypt::decrypt($item->mensagem)) !!}
                    </div>
                @else
                    <div class=" bg-info text-light p-3 text-center" style="border-radius: 20px; min-width: 150px;">
                        {!! nl2br(Crypt::decrypt($item->mensagem)) !!}
                    </div>
                @endif &nbsp; &nbsp;

                <div class="d-flex align-items-center ">
                    <button class="btn btn-danger " wire:click.prevent='eliminarMensagem({{ $item->id }})'>
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-start " style="font-size: 14px">
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
