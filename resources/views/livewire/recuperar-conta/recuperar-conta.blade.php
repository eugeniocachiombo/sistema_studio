<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Recuperação</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Recuperação</a></li>
                    <li class="breadcrumb-item active">Recuperação de conta</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <form>
                <div class="row gy-4 ">
                    <div class="col">
                        <div class="card card-animated p-4">
                            <div class="col-8 col-md-4">
                                <label class="text-primary fw-bold" for="">Email ou Telefone</label>
                                <input type="text" name="" id="" class="form-control mt-2"
                                    wire:model="email_telefone" placeholder="Digite o seu email ou telefone">

                                <div class="text-danger" style="font-size: 12.5px">
                                    @error('email_telefone')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col ">
                                <div class="col mt-3">
                                    <span class="text-primary" style="font-size: 20px" wire:loading
                                        wire:target='pesquisarEmailTelefone'>
                                        <span class="spinner-border spinner-border-sm"></span>
                                        Processando...
                                    </span>

                                    <button wire:loading.attr='disabled' wire:loading.remove
                                        wire:target='pesquisarEmailTelefone' wire:click.prevent="pesquisarEmailTelefone"
                                        class="btn btn-primary">
                                        Pesquisar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @if ($habilitarPasse == true)
                <div class="row gy-4 ">
                    <div class="col">
                        <div class="card card-animated p-4">
                            <span class="text-primary mb-1"
                                style="border-bottom: 2px solid rgb(17, 120, 238)">Utilizador Encontrado </span>
                            <span>Nome Completo: <span class="fw-bold">{{ $credenciais->buscarDadosPessoais->nome }}
                                    {{ $credenciais->buscarDadosPessoais->sobrenome }}</span> </span>
                            <span>Nome Artístico: <span class="fw-bold">{{ $credenciais->name }}</span></span>

                            <div class="col ">
                                <div class="col mt-3">
                                    <span class="text-primary" style="font-size: 20px" wire:loading
                                        wire:target='confirmarUtilizador'>
                                        <span class="spinner-border spinner-border-sm"></span>
                                        Processando...
                                    </span>

                                    <button wire:loading.attr='disabled' wire:loading.remove
                                        wire:target='confirmarUtilizador' wire:click.prevent="confirmarUtilizador"
                                        class="btn btn-success">
                                        Confirmar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($habilitarCampoConfirmacao == true)
                <div class="row gy-4 ">
                    <div class="col">
                        <div class="card card-animated p-4">
                            <div class="col-8 col-md-4">
                                <label class="text-primary fw-bold" for="">Código de confirmação</label>
                                <input type="text" maxlength="4" name="" id="" class="form-control mt-2"
                                    wire:model="codigoConfirmacao" placeholder="*****">

                                <div class="text-danger" style="font-size: 12.5px">
                                    @error('codigoConfirmacao')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col ">
                                <div class="col mt-3">
                                    <span class="text-primary" style="font-size: 20px" wire:loading
                                        wire:target='confirmarCodigo'>
                                        <span class="spinner-border spinner-border-sm"></span>
                                        Processando...
                                    </span>

                                    <button wire:loading.attr='disabled' wire:loading.remove
                                        wire:target='confirmarCodigo' wire:click.prevent="confirmarCodigo"
                                        class="btn btn-primary">
                                        Validar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </main>
</div>
