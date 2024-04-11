<div>
    <link rel="stylesheet" href="{{ asset('assets/css/paginacao-conversa.css') }}">
    <div>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Conversa</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Chat</a></li>
                        <li class="breadcrumb-item active">Conversa</li>
                    </ol>
                </nav>
            </div>

            <section class="section ">
                <div class="row gy-4">
                    <div class="col-8">
                        <div class="card card-animated p-4">
                            <caption>
                                <h4> <i class="bi bi-cursor-fill text-primary"></i> <b class="text-primary">Nome do
                                        utilizador</b> </h4>
                            </caption>
                            <hr>

                            <form wire:submit.prevent="enviarMensagem" class="php-email-form needs-validation"
                                novalidate>
                                <div class="row gy-4">
                                    <div class="col d-table">
                                        @if ($this->todasConversas->count() > 0)
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

                                                                    <div class=" bg-dark text-light col-8 p-3"
                                                                        style="border-radius: 5%">
                                                                        {{ $item->mensagem }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-content-end "
                                                                    style="font-size: 14px">
                                                                    Enviado: {{ $item->created_at }}
                                                                </div>
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

                                                                    <div class=" bg-info text-light col-8 p-3"
                                                                        style="border-radius: 5%">
                                                                        {{ $item->mensagem }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-content-start "
                                                                    style="font-size: 14px">
                                                                    Enviado: {{ $item->created_at }}
                                                                </div>
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

                                <div class="pagination justify-content-center">
                                    {{ $this->todasConversas->links()  }}
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" rows="5" wire:model="mensagem" rows="6"
                                        placeholder="Escreva sua mensagem aqui" required></textarea>
                                    <div class="text-danger pt-2" style="font-size: 12.5px">
                                        @error('mensagem')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 text-center d-flex">
                                    <div class="col">
                                        <button class="btn btn-primary btn-md" type="submit"
                                            wire:click='habilitarInputFile'>
                                            <i class="bi bi-upload "></i> Carregar arquivo
                                        </button>
                                    </div>

                                    <div class="col">
                                        <span class="text-primary" style="font-size: 20px" wire:loading
                                            wire:target='enviarMensagem'>
                                            <span class="spinner-border spinner-border-sm"></span>
                                            Processando...
                                        </span>
                                        <button class="btn btn-primary btn-lg" type="submit"
                                            wire:loading.attr='disabled' wire:loading.remove
                                            wire:target='enviarMensagem'>
                                            <i class="bi bi-cursor-fill text-light"></i> Enviar
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
</div>
</section>
</main>
</div>
</div>
