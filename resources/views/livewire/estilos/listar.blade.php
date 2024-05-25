<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Estilos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Estilo</a></li>
                    <li class="breadcrumb-item active">Listagem</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <div class="card card-animated p-4">
                <div class="col ">
                    <label class="text-primary fw-bold" for="">Lista de Estilos</label> <br>
                    <div class="col table-responsive pt-4">
                        <input type="text" class="form-control mb-3 d-none" wire:model="termoPesquisaMembros"
                            placeholder="Pesquisar cliente (id ou nome)...">

                        <table class="table datatablePT table-hover pt-3">
                            <thead class="">
                                <tr>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Id
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Estilo
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Preço de gravação
                                    </th>

                                    @if ($utilizador->tipo_acesso < 3)
                                        <th class="bg-primary text-white" style="white-space: nowrap">
                                            Registrado Por
                                        </th>
                                    @endif

                                    @if ($utilizador->tipo_acesso < 2)
                                        <th class="bg-primary text-white" style="white-space: nowrap">
                                            Editar
                                        </th>

                                        <th class="bg-primary text-white" style="white-space: nowrap">
                                            Eliminar
                                        </th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody class="">
                                @foreach ($listaEstilo as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tipo }}</td>
                                        <td>{{ number_format($item->preco, 2, ',', '.') }} kz</td>
                                        @if ($utilizador->tipo_acesso < 3)
                                            <td>{{ $item->buscarResponsavel ? $item->buscarResponsavel->name : '--' }}
                                            </td>
                                        @endif

                                        @if ($utilizador->tipo_acesso < 2)
                                            <td class="text-center" style="white-space: nowrap">
                                                <a href="{{ route('estilos.actualizar', [$item->id]) }}">
                                                    <button class="btn btn-success">
                                                        <i class="bi bi-pen"></i>
                                                    </button>
                                                </a>
                                            </td>

                                            <td class="text-center" style="white-space: nowrap">
                                                <button class="btn btn-danger"
                                                    wire:click.prevent="eliminarEstilo({{ $item->id }})">
                                                    <i class="bi bi-dash-circle"></i>
                                                </button>

                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
