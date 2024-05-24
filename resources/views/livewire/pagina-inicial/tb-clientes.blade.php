<div class="card card-animated recent-sales overflow-auto">
    <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
                <h6>Filtrar</h6>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <h5 class="card-title">Clientes <span>| Registro de todos clientes</span></h5>

        <table class="table table-borderless datatablePT table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center" style="white-space: nowrap">#</th>
                    <th scope="col" class="text-center" style="white-space: nowrap">Nome Completo</th>
                    <th scope="col" class="text-center" style="white-space: nowrap">Telefone</th>
                    <th scope="col" class="text-center" style="white-space: nowrap">Registrado</th>
                    <th scope="col" class="text-center" style="white-space: nowrap">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listaClientes as $item)
                    <tr>
                        <th class="text-center" scope="row"><a
                                href="{{ route('utilizador.anonimo', $item->id) }}">{{ $item->id }}</a>
                        </th>
                        <td class="text-center" style="white-space: nowrap"><a
                                href="{{ route('utilizador.anonimo', $item->id) }}"
                                class="text-dark">{{ $item->name }}</a></td>
                        <td class="text-center">
                            {{ $item->telefone }}
                        </td>
                        <td class="text-center">{{ $this->formatarData($item->created_at) }}</td>

                        <td>
                            @if ($item->buscarEstadoAprovacao)
                                <span class="badge bg-success">Aprovado</span>
                            @else
                                <span class="badge bg-danger">Não aprovado</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
