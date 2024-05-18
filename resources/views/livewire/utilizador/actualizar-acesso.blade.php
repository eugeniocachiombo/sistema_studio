<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Utilizador</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Acesso</a></li>
                    <li class="breadcrumb-item active">Actualizar</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <form>
                <div class="row gy-4 d-table d-md-flex">
                    <div class="col">
                        <div class="card card-animated p-4">
                            <span class="pb-2">Para: <span class="fw-bold">{{$dadosUtilizador->name}}</span> <br></span>
                            
                            <label class="text-primary fw-bold pb-2" for="">Acesso</label>
                            <select class="form-control" name="" id="" wire:model="tipo_acesso_id">
                                <option value="" class="d-none" selected>Escolha o acesso</option>
                                @foreach ($listaAcessos as $item)
                                    <option value="{{ $item->id }}">{{ $item->tipo }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" style="font-size: 12.5px">
                                @error('tipo_acesso_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col pt-3">
                                <button wire:click.prevent="actualizarAcesso" class="btn btn-primary">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
</div>
</form>
</section>
</main>
</div>
