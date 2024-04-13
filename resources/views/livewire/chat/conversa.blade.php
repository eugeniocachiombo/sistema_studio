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

            <section class="section">
                <div class="row gy-4">
                    <div class="col">
                        <div class="card card-animated p-4">
                            <caption>
                                <h4> <i class="bi bi-cursor-fill text-primary"></i> <b class="text-primary">Nome do
                                        Remente {{ $remente }}</b></h4>
                            </caption>
                            <hr>

                            @include('livewire.chat.mensagens')

                            <form wire:submit.prevent="enviarMensagem" class="php-email-form needs-validation"
                                novalidate>
                                <div class="col-md-12">
                                    @error('mensagem')
                                        <div class="alert alert-danger ">
                                            <span class="error">{{ $message }}</span>
                                        </div>
                                    @enderror
                                    <textarea class="form-control" rows="5" wire:model="mensagem" rows="6"
                                        placeholder="Escreva sua mensagem aqui" required></textarea>
                                </div>

                                <div class="col-md-12 text-center d-flex pt-4">
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
