@section('titulo', 'Contactos')
<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Contactos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Informações</a></li>
                    <li class="breadcrumb-item active">Contactos</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">

            <div class="row gy-4">

                <div class="col-xl-6">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="info-box card card-animated">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Endereço</h3>
                                <p>A108 Adam Street,<br>New York, NY 535022</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box card card-animated">
                                <i class="bi bi-telephone"></i>
                                <h3>Contactos Telefónicos</h3>
                                <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box card card-animated">
                                <i class="bi bi-envelope"></i>
                                <h3>Email</h3>
                                <p>info@example.com<br>contact@example.com</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box card card-animated">
                                <i class="bi bi-clock"></i>
                                <h3>Horários de Trabalho</h3>
                                <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card-animated p-4">
                        <caption>
                            <h4> <i class="bi bi-cursor-fill text-primary"></i> <b class="text-primary">Deixe sua
                                    mensagem</b> </h4>
                        </caption>
                        <hr>
                        <form wire:submit.prevent="enviarEmail" class="php-email-form needs-validation" novalidate>
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" wire:model="nome" class="form-control" placeholder="Seu nome"
                                        required>
                                    <div class="text-danger pt-2" style="font-size: 12.5px">
                                        @error('nome')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" wire:model="email"
                                        placeholder="Seu Email" required>
                                    <div class="text-danger pt-2" style="font-size: 12.5px">
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" wire:model="assunto"
                                        placeholder="Assunto" required>
                                    <div class="text-danger pt-2" style="font-size: 12.5px">
                                        @error('assunto')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" wire:model="mensagem" rows="6" placeholder="Mensagem" required></textarea>
                                    <div class="text-danger pt-2" style="font-size: 12.5px">
                                        @error('mensagem')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <span class="text-primary" style="font-size: 20px" wire:loading wire:target='enviarEmail'>
                                        <span class="spinner-border spinner-border-sm"></span>
                                            Processando...
                                    </span>
                                    <button type="submit" wire:loading.attr='disabled' 
                                        wire:loading.remove wire:target='enviarEmail'>
                                                Enviar Mensagem
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>
