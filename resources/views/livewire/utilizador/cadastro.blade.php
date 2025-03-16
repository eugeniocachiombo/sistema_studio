@section('titulo', 'Cadastro')
<div>
    <main>
        <div class="container ">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container ">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
                            @include('inclusao.logo&nome')

                            <div class="card card-animated mb-3 ">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Criar uma conta</h5>
                                        <p class="text-center text-primary small"><b>Preencha os campos</b></p>
                                        <hr>
                                    </div>

                                    <form class="row g-3 needs-validation" wire:submit.prevent="cadastrar" novalidate>
                                        <div class="col ">
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6">
                                                    <label for="nome" class="form-label">Nome</label>
                                                    <input type="text" name="nome" class="form-control border "
                                                        wire:model="nome" required placeholder="Seu nome">
                                                    <div class="text-danger pt-2" style="font-size: 12.5px">
                                                        @error('nome')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <label for="sobrenome" class="form-label">Sobrenome</label>
                                                    <input type="text" name="sobrenome" class="form-control border "
                                                        wire:model="sobrenome" required placeholder="Seu sobrenome">
                                                    <div class="text-danger pt-2" style="font-size: 12.5px">
                                                        @error('sobrenome')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="nomeArtistico" class="form-label">Nome Artístico</label>
                                            <input type="text" name="nomeArtistico" class="form-control border "
                                                wire:model="nomeArtistico" required placeholder="Seu nome artístico">
                                            <div class="text-danger pt-2" style="font-size: 12.5px">
                                                @error('nomeArtistico')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text bg-white text-primary"
                                                    id="inputGroupPrepend">@</span>
                                                <input type="email" name="email" class="form-control border "
                                                    id="email" required wire:model="email" placeholder="nome@exemplo.com">
                                            </div>
                                            <div class="text-danger pt-2" style="font-size: 12.5px">
                                                @error('email')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="telefone" class="form-label">Telefone</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text bg-white text-primary"
                                                    id="inputGroupPrepend">AO +244</span>
                                                <input type="text" minlength="9" maxlength="9" name="telefone"
                                                    class="form-control border " id="telefone" wire:model="telefone"
                                                    required placeholder="9xxxxxxxx">
                                            </div>
                                            <div class="text-danger pt-2" style="font-size: 12.5px">
                                                @error('telefone')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="passe" class="form-label">Palavra-passe</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text bg-white text-primary"
                                                    id="inputGroupPrepend"><i class="fas fa-key"></i></span>
                                                <input type="password" name="passe" class="form-control border "
                                                    wire:model="passe" required placeholder="******">
                                            </div>
                                            <div class="text-danger pt-2" style="font-size: 12.5px">
                                                @error('passe')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="nascimento" class="form-label">Data de nascimento</label>
                                            <div class="input-group has-validation">
                                                <input type="date" name="nascimento" class="form-control border "
                                                    wire:model="nascimento" required placeholder="00/00/0000">
                                            </div>
                                            <div class="text-danger pt-2" style="font-size: 12.5px">
                                                @error('nascimento')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 pt-2 "
                                            style="background: rgb(212, 212, 212); border-radius: 10px">
                                            <label for="genero" class="form-label">Gênero </label>
                                            <div class="col-sm-10 d-flex justify-content-around pb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios1" value="M" wire:model="genero">
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Masculino
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gridRadios"
                                                        id="gridRadios2" value="F" wire:model="genero">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Femenino
                                                    </label>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="col-12 text-danger pb-2" style="font-size: 12.5px">
                                            @error('genero')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="aceitarTermos" type="checkbox"
                                                     wire:model="aceitarTermos" required id="aceitarTermos">
                                                <label class="form-check-label" for="aceitarTermos">Eu aceito e
                                                    concordo
                                                    com as <span class="text-primary"> políticas e segurança</span></label>
                                            </div>
                                            <div class="text-danger pt-2" style="font-size: 12.5px">
                                                @error('aceitarTermos')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Criar conta</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Você já tem uma conta? <a
                                                    href="{{ route('utilizador.autenticacao') }}"><b>Autenticar-se</b></a>
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
