<div>
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
    
            <section class="section contact">
                <div class="row gy-4">
                    <div class="col-xl-6">
                        <div class="card card-animated p-4">
                            <caption>
                                <h4> <i class="bi bi-cursor-fill text-primary"></i> <b class="text-primary">Nome do utilizador</b> </h4>
                            </caption>
                            <hr>
                            <form wire:submit.prevent="enviarEmail" class="php-email-form needs-validation" novalidate>
                                <div class="row gy-4">
                                    <div class="col text-center">
                                        <b class="">Não existe conversa com este utilizador</b>
                                    </div>
    
                                    <div class="col-md-12">
                                        <textarea class="form-control" rows="5" wire:model="mensagem" rows="6" placeholder="Escreva sua mensagem aqui" required></textarea>
                                        <div class="text-danger pt-2" style="font-size: 12.5px">
                                            @error('mensagem')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="col-md-12 text-center d-flex">
                                        <div class="col">
                                            BtN upload
                                        </div>
                                        
                                        <div class="col">
                                            <span class="text-primary" style="font-size: 20px" wire:loading wire:target='enviarEmail'>
                                                <span class="spinner-border spinner-border-sm"></span>
                                                    Processando...
                                            </span>
                                            <button type="submit" wire:loading.attr='disabled' 
                                                wire:loading.remove wire:target='enviarEmail'>
                                                <i class="bi bi-cursor-fill text-light"></i>  Enviar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
    
        </main>
    </div>
</div>
