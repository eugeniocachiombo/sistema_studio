<div class="card-body">
    <h5 class="card-title">Clientes <span>| Hoje</span></h5>

    <table class="table table-borderless datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome Completo</th>
                <th scope="col">Tipo de Acesso</th>
                <th scope="col">Morada</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listaClientes as $item)
                <tr>
                    <th scope="row"><a href="#">{{ $item->id }}</a>
                    </th>
                    <td>{{ $item->name }}</td>
                    <td>
                        {{ ucwords($item->buscarTipoAcesso->tipo) }}
                    </td>
                    <td>Morada</td>
                    <td><span class="badge bg-success">Approved</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
