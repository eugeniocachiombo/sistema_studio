<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Grupos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Grupo</a></li>
                    <li class="breadcrumb-item active">Criar</li>
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
                                            <label class="text-primary fw-bold mb-2" for="">Grupo</label> <br>
                                        <input type="text" name="" id="" class="form-control "
                                            placeholder="Nome do grupo" wire:model="nomeGrupo">
                                        <div class="text-danger" style="font-size: 12.5px">
                                            @error('nomeGrupo')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>

                                    </div>
                                    <div class="col mt-3">
                                        <button wire:click.prevent="criarGrupo" class="btn btn-primary">
                                            Criar Grupo
                                        </button>
                                    </div>
                                </div>
                            </div>

                            @if ($tbMembrosGrupo)
                            <div class="col ">
                                <div class="col-12 card card-animated p-4 d-table d-md-flex">
                                    <label class="text-primary fw-bold" for="">Adicionar Membros ao
                                        grupo</label> <br>
                                    <div class="col table-responsive">
                                        <input type="text" class="form-control mb-3"
                                            wire:model="termoPesquisaMembros"
                                            placeholder="Pesquisar cliente (id ou nome)...">

                                        <table class="table table-hover table-light">
                                            <thead class="">
                                                <tr>
                                                    <th>
                                                        Id
                                                    </th>
                                                    <th>
                                                        Foto
                                                    </th>
                                                    <th>
                                                        Nome
                                                    </th>
                                                    <th>
                                                        Selecionar
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="">
                                                @foreach ($listaMembrosClientes as $item)
                                                    <tr>
                                                        <th>{{ $item->id }}</th>
                                                        <th>
                                                            @php
                                                                $fotoUtilizador = $this->buscarFotoPerfil($item->id);
                                                            @endphp
                                                            @if ($fotoUtilizador)
                                                                <a
                                                                    href="{{ asset('assets/' . $fotoUtilizador->caminho_arquivo) }}">
                                                                    <img src="{{ asset('assets/' . $fotoUtilizador->caminho_arquivo) }}"
                                                                        class="rounded-circle" alt="foto"
                                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                                </a>
                                                            @else
                                                                <img src="{{ asset('assets/img/img_default.jpg') }}"
                                                                    alt="foto"
                                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                                            @endif
                                                        </th>
                                                        <th>{{ $item->name }}</th>
                                                        <th>
                                                            <input type="checkbox" value="{{ $item->id }}"
                                                                wire:model="clientesEscolhidos.{{ $item->id }}">
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>

                                        <hr>
                                        <p>
                                            <span class="text-primary fw-bold">Participantes: </span>
                                            @php
                                                $clienteEscolhidos = '';
                                            @endphp

                                            @foreach ($clientesEscolhidos as $item)
                                                @php
                                                    $clienteEscolhidos .= $this->buscarNomeCliente($item);
                                                @endphp
                                            @endforeach

                                            <span class="text-dark fw-bold">
                                                {{ $clienteEscolhidos = rtrim($clienteEscolhidos, ', ') }}
                                            </span>
                                        </p>
                                        <hr>

                                        <button wire:click.prevent="adicionarMembrosAoGrupo" class="btn btn-primary">
                                            Adicionar Membros
                                        </button>

                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
</div>
