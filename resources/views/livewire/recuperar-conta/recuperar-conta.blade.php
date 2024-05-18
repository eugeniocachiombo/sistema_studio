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
                            <div class="col-6">
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
                                    <button wire:click.prevent="pesquisarEmailTelefone" class="btn btn-primary">
                                        Pesquisar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

</div>
</form>
</section>
</main>
</div>
