<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Estilos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Estilo</a></li>
                    <li class="breadcrumb-item active">Adicionar</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <form>
                <div class="row gy-4 d-table d-md-flex">
                    <div class="col">
                        <div class="card card-animated p-4 ">
                            <div class="d-table d-md-flex justify-content-between">
                                <div class="col m-3">
                                    <div class="row g-3">
                                        <div class="col-8 col-md-4">
                                            <label class="text-primary fw-bold mb-2" for="">Estilo</label> <br>
                                            <input type="text" name="" id="" class="form-control "
                                                placeholder="Tipo de estilo" wire:model="tipo">
                                            <div class="text-danger" style="font-size: 12.5px">
                                                @error('tipo')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-8 col-md-4">
                                            <label class="text-primary fw-bold mb-2" for="">Preço da
                                                Gravação</label> <br>
                                            <select class="form-control" wire:model="preco" name=""
                                                id="">
                                                <option value="" class="d-none">Selecione o preço</option>
                                                <?php $preco = 10000; ?>
                                                @while ($preco <= 25000)
                                                    <option value="{{ $preco }}">
                                                        {{ number_format($preco, 2, ',', '.') }}</option>
                                                    <?php $preco += 1000; ?>
                                                @endwhile

                                            </select>
                                            <div class="text-danger" style="font-size: 12.5px">
                                                @error('preco')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col mt-3">
                                        <button wire:click.prevent="criarEstilo" class="btn btn-primary">
                                            Criar Estilo
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
