<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Utilizadores</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Utilizadores</a></li>
                    <li class="breadcrumb-item active">Listagem de todos</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <div class="card card-animated p-4">
                <div class="col ">
                    <label class="text-primary fw-bold" for="">Lista de Utilizadores</label> <br>
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
                                        Nome completo
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Nome Artístico
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Gênero
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Data de nascimento
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Acesso
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Email
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Telefone
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Nacionalidade
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Sobre
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
                                @foreach ($listaUtilizadores as $item)
                                    <tr>
                                        <td class="bg-primary text-white text-center" style="white-space: nowrap">
                                            {{ $item->id }}</td>

                                        <td style="white-space: nowrap">
                                            <div class="d-flex">
                                                <div>
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

                                                    <a href="{{ route('utilizador.anonimo', $item->id) }}">
                                                        {{ $item->buscarDadosPessoais->nome }}
                                                        {{ $item->buscarDadosPessoais->sobrenome}}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                        <td style="white-space: nowrap">
                                            {{ $item->name }}
                                        </td>

                                        <td style="white-space: nowrap">
                                            {{ $item->buscarDadosPessoais->genero}}
                                        </td>

                                        <td style="white-space: nowrap">
                                            {{ $this->buscarNascimento( $item->buscarDadosPessoais->nascimento)}}
                                        </td>

                                        <td style="white-space: nowrap">
                                            {{ $item->buscarTipoAcesso->tipo }}
                                        </td>

                                        <td style="white-space: nowrap">
                                            {{ $item->email }}
                                        </td>

                                        <td style="white-space: nowrap">
                                            {{ $item->telefone }}
                                        </td>

                                        <td style="white-space: nowrap">
                                            {{ $item->buscarDadosPessoais->nacionalidade}}
                                        </td>

                                        <td style="white-space: nowrap">
                                            {{ $item->buscarDadosPessoais->sobre}}
                                        </td>

                                        <td class="text-center" style="white-space: nowrap">
                                            <a href="{{ route('utilizador.actualizar_acesso', [$item->id]) }}">
                                                <button class="btn btn-success">
                                                    <i class="bi bi-pen"></i>
                                                </button>
                                            </a>
                                        </td>

                                        <td class="text-center" style="white-space: nowrap">
                                                <button class="btn btn-danger"
                                                    wire:click.prevent="eliminarUtilizador({{ $item->id }})">
                                                    <i class="bi bi-dash-circle"></i>
                                                </button>
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
