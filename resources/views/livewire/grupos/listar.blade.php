<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Grupos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Grupo</a></li>
                    <li class="breadcrumb-item active">Listagem</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <div class="card card-animated p-4">
                <div class="col ">
                    <label class="text-primary fw-bold" for="">Lista de Grupos</label> <br>
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
                                        Nome do Grupo
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Membros
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Estilo
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Registrado Por
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Editar
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Eliminar
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="">
                                @foreach ($listaGrupo as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->nome}}</td>
                                        <td style="min-width: 200px">
                                            @php
                                                $idGrupo = $item->id;
                                                $todosMembros = $this->buscarClientesGrupo($idGrupo);
                                                $mebrosEscolhidos = $this->cortarUltimavirgula($todosMembros);
                                            @endphp

                                            {{ $mebrosEscolhidos ? '' . $mebrosEscolhidos . '' : 'Nenhum' }}
                                        </td>
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
