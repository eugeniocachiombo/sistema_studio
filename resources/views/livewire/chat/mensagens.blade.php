@php
$pagina_atual = 0;
$itens_por_pagina = 10;

if (isset($_GET['pagina'])) {
    $pagina_atual = $_GET['pagina'];
} else {
    $pagina_atual = 1;
}

$offset = ($pagina_atual - 1) * $itens_por_pagina;
$total_itens = 100; 
$total_paginas = ceil($total_itens / $itens_por_pagina);
$this->todasConversas = DB::select('select * from chat ' .
' where emissor = ' .  $this->utilizador_id .' and receptor = ' . $this->remente .
' or ' .
' receptor = ' . $this->utilizador_id . ' and emissor = '  . $this->remente .
' ORDER BY id DESC limit ' . $itens_por_pagina . ' offset '  . $offset );
@endphp

<div class="row gy-4">
    <div class="col d-table">
        @if (count($this->todasConversas) > 0)
            @foreach (array_reverse($this->todasConversas) as $item)
                <div class="col text-center pt-4">
                    @if ($this->utilizador_id == $item->emissor)
                        <div class="container">
                            <div class=" d-flex flex-column">
                                <div class="col text-end">
                                    <span class="col ">
                                        <b>User logado {{ $item->emissor }}</b>
                                    </span>
                                </div>

                                <div class="col d-flex justify-content-end">
                                    @if ($item->caminho_arquivo != '' && $item->tipo_arquivo != '')
                                        <div class=" col-6 p-3">
                                            @switch($item->tipo_arquivo)
                                                @case('img')
                                                    <a
                                                        href="{{ url('storage/' . $item->caminho_arquivo) }}">
                                                        <img src="{{ url('storage/' . $item->caminho_arquivo) }}"
                                                            alt="foto" width="100%">
                                                    </a>
                                                @break

                                                @case('audio')
                                                    <audio controls>
                                                        <source
                                                            src="{{ url('storage/' . $item->caminho_arquivo) }}"
                                                            type="audio/mpeg">
                                                        Your browser does not support the audio
                                                        element.
                                                    </audio>
                                                @break

                                                @case('texto')
                                                    <a
                                                        href="{{ url('storage/' . $item->caminho_arquivo) }}">{{ $item->nome_arquivo }}</a> <br>
                                                @break

                                                @default
                                            @endswitch
                                            {{ Crypt::decrypt($item->mensagem) }}
                                        </div>
                                    @else
                                        @if (strlen(Crypt::decrypt($item->mensagem)) > 20)
                                            <div class=" bg-dark text-light p-3 text-start"
                                                style="border-radius: 5%;">
                                                {{ Crypt::decrypt($item->mensagem) }}
                                            </div>
                                        @else
                                            <div class=" bg-dark text-light p-3 text-center"
                                                style="border-radius: 5%; min-width: 150px;">
                                                {{ Crypt::decrypt($item->mensagem) }}
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <div class="d-flex justify-content-end "
                                    style="font-size: 14px">
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
                    @else
                        <div class="container">
                            <div class=" d-flex flex-column">
                                <div class="col text-start">
                                    <span class="col ">
                                        <b>Eugénio {{ $item->emissor }}</b>
                                    </span>
                                </div>

                                <div class="col d-flex justify-content-start">
                                    @if ($item->caminho_arquivo != '' && $item->tipo_arquivo != '')
                                        <div class=" col-6 p-3">
                                            @switch($item->tipo_arquivo)
                                                @case('img')
                                                    <a
                                                        href="{{ url('storage/' . $item->caminho_arquivo) }}">
                                                        <img src="{{ url('storage/' . $item->caminho_arquivo) }}"
                                                            alt="foto" width="100%">
                                                    </a>
                                                @break

                                                @case('audio')
                                                    <audio controls>
                                                        <source
                                                            src="{{ url('storage/' . $item->caminho_arquivo) }}"
                                                            type="audio/mpeg">
                                                        Your browser does not support the audio
                                                        element.
                                                    </audio>
                                                @break

                                                @case('texto')
                                                    <a href="{{ url('storage/' . $item->caminho_arquivo) }}">{{ $item->nome_arquivo }}</a> <br>
                                                @break

                                                @default
                                            @endswitch
                                            {{ Crypt::decrypt($item->mensagem) }}
                                        </div>
                                    @else
                                        @if (strlen(Crypt::decrypt($item->mensagem)) > 20)
                                            <div class=" bg-info text-light p-3 text-start"
                                                style="border-radius: 5%;">
                                                {{ Crypt::decrypt($item->mensagem) }}
                                            </div>
                                        @else
                                            <div class=" bg-info text-light p-3 text-center"
                                                style="border-radius: 5%; min-width: 150px;">
                                                {{ Crypt::decrypt($item->mensagem) }}
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <div class="d-flex justify-content-start "
                                    style="font-size: 14px">
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
                    @endif
                </div>
            @endforeach
        @else
            <div class="col text-center">
                <b class="">Não existe conversa com este utilizador</b>
            </div>
        @endif

        @if ($this->habilitarUpload == true)
            <div
                class="col bg-primary aling-items-center d-flex justify-content-between mt-4 border">
                <div class="col">
                    <label for="file-input" class="file-input">
                        Escolha um arquivo
                        <input type="file" wire:model="arquivo" name="file"
                            id="file-input">
                    </label>
                </div>

                <div class="col  d-flex  align-items-center">
                    <span class="text-light"
                        id="nomeArquivo">{{ $arquivo ? $this->nomeArquivo : 'Nenhum arquivo escolhido' }}</span>
                </div>
            </div>

        @empty($arquivo)
            <div class="container d-table bg-primary text-light  align-items-center">
                <div class="row">
                    <div class="col">
                        <b>Somente Com Extensões:</b>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @foreach ($this->extensoesAceites as $chave => $extensao)
                            @for ($i = 0; $i < count($extensao); $i++)
                                {{ $extensao[$i] . ' -' }}
                            @endfor
                        @endforeach
                    </div>
                </div>
            </div>
        @endempty
    @endif
</div>

<div class="pagination justify-content-center ">
    <div class="col d-flex justify-content-around">
        <div class="pagination-next">
            @if ($pagina_atual > 1)
                <a class="btn btn-light text-primary border"
                    href="{{'?pagina='.$pagina_atual - 1}}">
                    <span class="mr-2"><i
                            class="bi bi-arrow-left-circle-fill"></i> <b>Voltar</b> </span>
                </a>
            @endif
        </div>

        <div class="pagination-previous">
            @if ($pagina_atual < $total_paginas)
                <a class="btn btn-light text-primary border"
                    href="{{ '?pagina='.$pagina_atual + 1 }}">
                    <span class="mr-2"> <b>Ver mais</b> <i
                            class="bi bi-arrow-right-circle-fill"></i></i></span>
                </a>
            @endif
        </div>
    </div>
</div>




{{--
<div class="row gy-4 d-none">
    <div class="col d-table">
        @if (count($this->todasConversas) > 0)
            @foreach ($this->todasConversas->reverse() as $item)
                <div class="col text-center pt-4">
                    @if ($this->utilizador_id == $item->emissor)
                        <div class="container">
                            <div class=" d-flex flex-column">
                                <div class="col text-end">
                                    <span class="col ">
                                        <b>User logado {{ $item->emissor }}</b>
                                    </span>
                                </div>

                                <div class="col d-flex justify-content-end">
                                    @if ($item->caminho_arquivo != '' && $item->tipo_arquivo != '')
                                        <div class=" col-6 p-3">
                                            @switch($item->tipo_arquivo)
                                                @case('img')
                                                    <a
                                                        href="{{ url('storage/' . $item->caminho_arquivo) }}">
                                                        <img src="{{ url('storage/' . $item->caminho_arquivo) }}"
                                                            alt="foto" width="100%">
                                                    </a>
                                                @break

                                                @case('audio')
                                                    <audio controls>
                                                        <source
                                                            src="{{ url('storage/' . $item->caminho_arquivo) }}"
                                                            type="audio/mpeg">
                                                        Your browser does not support the audio
                                                        element.
                                                    </audio>
                                                @break

                                                @case('texto')
                                                    <a
                                                        href="{{ url('storage/' . $item->caminho_arquivo) }}">{{ $item->nome_arquivo }}</a> <br>
                                                @break

                                                @default
                                            @endswitch
                                            {{ Crypt::decrypt($item->mensagem) }}
                                        </div>
                                    @else
                                        @if (strlen(Crypt::decrypt($item->mensagem)) > 20)
                                            <div class=" bg-dark text-light p-3 text-start"
                                                style="border-radius: 5%;">
                                                {{ Crypt::decrypt($item->mensagem) }}
                                            </div>
                                        @else
                                            <div class=" bg-dark text-light p-3 text-center"
                                                style="border-radius: 5%; min-width: 150px;">
                                                {{ Crypt::decrypt($item->mensagem) }}
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <div class="d-flex justify-content-end "
                                    style="font-size: 14px">
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
                    @else
                        <div class="container">
                            <div class=" d-flex flex-column">
                                <div class="col text-start">
                                    <span class="col ">
                                        <b>Eugénio {{ $item->emissor }}</b>
                                    </span>
                                </div>

                                <div class="col d-flex justify-content-start">
                                    @if ($item->caminho_arquivo != '' && $item->tipo_arquivo != '')
                                        <div class=" col-6 p-3">
                                            @switch($item->tipo_arquivo)
                                                @case('img')
                                                    <a
                                                        href="{{ url('storage/' . $item->caminho_arquivo) }}">
                                                        <img src="{{ url('storage/' . $item->caminho_arquivo) }}"
                                                            alt="foto" width="100%">
                                                    </a>
                                                @break

                                                @case('audio')
                                                    <audio controls>
                                                        <source
                                                            src="{{ url('storage/' . $item->caminho_arquivo) }}"
                                                            type="audio/mpeg">
                                                        Your browser does not support the audio
                                                        element.
                                                    </audio>
                                                @break

                                                @case('texto')
                                                    <a href="{{ url('storage/' . $item->caminho_arquivo) }}">{{ $item->nome_arquivo }}</a> <br>
                                                @break

                                                @default
                                            @endswitch
                                            {{ Crypt::decrypt($item->mensagem) }}
                                        </div>
                                    @else
                                        @if (strlen(Crypt::decrypt($item->mensagem)) > 20)
                                            <div class=" bg-info text-light p-3 text-start"
                                                style="border-radius: 5%;">
                                                {{ Crypt::decrypt($item->mensagem) }}
                                            </div>
                                        @else
                                            <div class=" bg-info text-light p-3 text-center"
                                                style="border-radius: 5%; min-width: 150px;">
                                                {{ Crypt::decrypt($item->mensagem) }}
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <div class="d-flex justify-content-start "
                                    style="font-size: 14px">
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
                    @endif
                </div>
            @endforeach
        @else
            <div class="col text-center">
                <b class="">Não existe conversa com este utilizador</b>
            </div>
        @endif

        @if ($this->habilitarUpload == true)
            <div
                class="col bg-primary aling-items-center d-flex justify-content-between mt-4 border">
                <div class="col">
                    <label for="file-input" class="file-input">
                        Escolha um arquivo
                        <input type="file" wire:model="arquivo" name="file"
                            id="file-input">
                    </label>
                </div>

                <div class="col  d-flex  align-items-center">
                    <span class="text-light"
                        id="nomeArquivo">{{ $arquivo ? $this->nomeArquivo : 'Nenhum arquivo escolhido' }}</span>
                </div>
            </div>

        @empty($arquivo)
            <div class="container d-table bg-primary text-light  align-items-center">
                <div class="row">
                    <div class="col">
                        <b>Somente Com Extensões:</b>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        @foreach ($this->extensoesAceites as $chave => $extensao)
                            @for ($i = 0; $i < count($extensao); $i++)
                                {{ $extensao[$i] . ' -' }}
                            @endfor
                        @endforeach
                    </div>
                </div>
            </div>
        @endempty
    @endif
</div>

<div class="pagination justify-content-center ">
    <div class="col d-flex justify-content-around">
        <div class="pagination-next">
            @if ($this->todasConversas->previousPageUrl())
                <a class="btn btn-light text-primary border"
                    href="{{ $this->todasConversas->previousPageUrl() }}">
                    <span class="mr-2"><i
                            class="bi bi-arrow-left-circle-fill"></i> <b>Voltar</b> </span>
                </a>
            @endif
        </div>

        <div class="pagination-previous">
            @if ($this->todasConversas->nextPageUrl())
                <a class="btn btn-light text-primary border"
                    href="{{ $this->todasConversas->nextPageUrl() }}">
                    <span class="mr-2"> <b>Ver mais</b> <i
                            class="bi bi-arrow-right-circle-fill"></i></i></span>
                </a>
            @endif
        </div>
    </div>
</div>
--}}