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
                                <h4>  <b class="text-primary">
                                    <a href="{{route('utilizador.anonimo', $remente)}}">
                                        @php
                                            $foto = $this->buscarFotoPerfil($remente);
                                        @endphp
                                        @if ($foto)
                                                <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}" 
                                                class="rounded-circle me-2" alt="foto" style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                                <img src="{{ asset('assets/img/img_default.jpg') }}" 
                                                class="me-2"  alt="foto" style="width: 40px; height: 40px; object-fit: cover;">
                                        @endif
                                        
                                        {{ $this->buscarNomeUsuario($remente) }}
                                    </a>
                                </b>
                                </h4> 
                            </caption>
                            <hr>

                            @include('livewire.chat.inc.mensagens')

                            <form wire:submit.prevent="enviarMensagem" class="php-email-form needs-validation"
                                novalidate>
                                <div class="col-md-12">
                                    @if ($ocultarValidate == false)
                                        @error('mensagem')
                                            <div class="alert alert-danger ">
                                                <span class="error">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    @endif
                                    <textarea class="form-control" rows="{{$rowsMessagem ? $rowsMessagem : 5}}" wire:model="mensagem"
                                        placeholder="{{ $placeholderMsg ? $placeholderMsg : 'Escreva sua mensagem aqui' }}" required></textarea>
                                </div>

                                <div class="col-md-12 text-center d-flex pt-4">
                                    <div class="col">
                                        <a class="btn btn-primary btn-md" 
                                        wire:click='habilitarInputFile'>
                                            <i class="bi bi-upload "></i> Carregar arquivo
                                        </a>
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

<script src="{{ asset('assets/js/temporeal_conversa.js') }}"></script>