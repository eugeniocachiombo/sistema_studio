<div class="card card-animated recent-sales overflow-auto">
    <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                class="bi bi-three-dots"></i></a>
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
                <th scope="col" style="white-space: nowrap">#</th>
                <th scope="col" style="white-space: nowrap">Nome Completo</th>
                <th scope="col" style="white-space: nowrap">Acesso</th>
                <th scope="col" style="white-space: nowrap">Morada</th>
                <th scope="col" style="white-space: nowrap">Registrado</th>
                <th scope="col" style="white-space: nowrap">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listaClientes as $item)
                <tr>
                    <th scope="row"><a href="{{route('chat.conversa', [$utilizador_id, $item->id])}}">{{ $item->id }}</a>
                    </th>
                    <td style="white-space: nowrap"><a href="{{route('chat.conversa', [$utilizador_id, $item->id])}}" class="text-dark">{{ $item->name }}</a></td>
                    <td>
                        {{ ucwords($item->buscarTipoAcesso->tipo) }}
                    </td>
                    <td>Morada</td>
                    <td>{{ $this->formatarData($item->created_at) }}</td>
                    <td><span class="badge bg-success">Approved</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
