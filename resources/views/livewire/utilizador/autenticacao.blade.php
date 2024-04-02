<div>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="" class="logo d-flex align-items-center w-auto">
                                    <img src="../assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div>

                            <div class="card card-animated mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Autenticação</h5>
                                        <p class="text-center text-primary small"><b>Entre com o seu Email e
                                                Palavra-passe</b></p>
                                        <hr>
                                    </div>

                                    <form wire:submit.prevent="logar" class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email:</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text bg-white text-primary"
                                                    id="inputGroupPrepend"><i class="fas fa-user"></i></span>
                                                <input type="text" wire:model="email" class="form-control"
                                                    id="email" required>
                                            </div>

                                            <div class="text-danger" style="font-size: 12.5px">
                                                @error('email')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="palavrapasse" class="form-label">Palavra-Passe:</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text bg-white text-primary"
                                                    id="inputGroupPrepend"><i class="fas fa-key"></i></span>
                                                <input type="password" wire:model="palavra_passe" class="form-control"
                                                    id="palavrapasse" required>
                                            </div>
                                            <div class="text-danger" style="font-size: 12.5px">
                                                @error('palavra_passe')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true"
                                                    id="lembrame" wire:model="lembre_me">
                                                <label class="form-check-label" for="lembrame">Lembre-me</label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <span class="text-primary" style="font-size: 20px" 
                                                wire:loading wire:target='logar'>
                                                <span class="spinner-border spinner-border-sm"></span>
                                                    Processando...
                                            </span>
                                            <button class="btn btn-primary w-100" type="submit" wire:loading.attr='disabled' 
                                                wire:loading.remove wire:target='logar'>
                                                    Iniciar Sessão
                                            </button>
                                        </div>

                                        <div class="col-12">
                                            <p class="small mb-0">Não tem uma conta?
                                                <a href="{{route("utilizador.cadastro")}}"><b>Criar
                                                        uma conta</b></a>
                                            </p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            @include('inclusao.contactenos')
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

