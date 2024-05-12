<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Gravação</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Gravação</a></li>
                    <li class="breadcrumb-item active">Concluir</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <div class="card card-animated p-4">
                <div class="col ">
                    <label class="text-primary fw-bold" for="">Concluir de Gravações Agendadas</label> <br>
                    <div class="col table-responsive pt-4">
                        <input type="text" class="form-control mb-3 d-none" wire:model="termoPesquisaMembros"
                            placeholder="Pesquisar cliente (id ou nome)...">

                        <table class="table datatablePT table-hover pt-3">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Id
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Proprietário
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Título do áudio
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Participação
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Estilo
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Data da gravação
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Estado
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Concluido
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Acção
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="">
                                @foreach ($listaGravacao as $item)
                                    <tr>
                                        <td class="bg-success text-white" style="white-space: nowrap">{{ $item->id }}</td>
                                        <td style="white-space: nowrap">
                                            <div class="d-flex">
                                                <div>
                                                    @php
                                                        $proprietario = '';
                                                    @endphp

                                                    @if ($item->cliente_id)
                                                        @php
                                                            $cliente = $this->buscarUtilizador($item->cliente_id);
                                                            $fotoUtilizador = $this->buscarFotoPerfil($cliente->id);
                                                            $proprietario = $cliente->name;
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
                                                    @elseif($item->grupo_id)
                                                        @php
                                                            $proprietario =
                                                                $this->buscarGrupo($item->grupo_id)->nome . ' (Grupo)';
                                                        @endphp
                                                    @endif

                                                </div>
                                                <div class="d-flex align-items-center ms-1 text-primary">
                                                    {{ $proprietario }}</div>
                                            </div>
                                        </td>
                                        <td class="bg-success text-white" style="min-width: 200px">{{ $item->titulo_audio }}</td>
                                        <td style="min-width: 200px">
                                            @php
                                                $idGravacao = $item->id;
                                                $todosParticipantes = $this->buscarParticipantesGravacao($idGravacao);
                                                $particEscolhidos = $this->cortarUltimavirgula($todosParticipantes);
                                            @endphp

                                            {{ $particEscolhidos ? 'Feat. ( ' . $particEscolhidos . ' )' : 'Nenhum' }}
                                        </td>
                                        <td class="bg-success text-white" style="white-space: nowrap">
                                            {{ $this->buscarEstilos($item->estilo_audio) ? $this->buscarEstilos($item->estilo_audio)->tipo : '' }}
                                        </td>
                                        <td style="white-space: nowrap">{{ $item->data_gravacao }}</td>
                                        <td style="white-space: nowrap">
                                            @if ($item->estado_gravacao == 'gravado')
                                                <span class="badge bg-success text-light ">
                                                    {{ ucwords($item->estado_gravacao) }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger text-light ">
                                                    {{ ucwords($item->estado_gravacao) }}
                                                </span>
                                            @endif
                                        </td>

                                        @if ($item->estado_gravacao == 'gravado')
                                            <td style="white-space: nowrap">
                                                {{ $this->formatarData($item->updated_at) }}
                                            </td>
                                        @else
                                            <td style="white-space: nowrap">
                                                --
                                            </td>
                                        @endif

                                        <td style="white-space: nowrap" class="text-center">
                                            @if ($item->estado_gravacao == 'gravado')
                                                <i class="bi bi-check text-success display-6 "></i>
                                            @else
                                                <button class="btn btn-success"
                                                    wire:click.prevent="concluirAgendamento({{ $idGravacao }})">
                                                    Concluir
                                                </button>
                                            @endif
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
