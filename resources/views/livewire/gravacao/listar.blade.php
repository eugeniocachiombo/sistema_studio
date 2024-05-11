<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Gravação</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Gravação</a></li>
                    <li class="breadcrumb-item active">Listagem</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <div class="card card-animated p-4">
                <div class="col ">
                    <label class="text-primary fw-bold" for="">Lista de Gravações Agendadas</label> <br>
                    <div class="col table-responsive pt-4">
                        <input type="text" class="form-control mb-3 d-none" wire:model="termoPesquisaMembros"
                            placeholder="Pesquisar cliente (id ou nome)...">

                        <table class="table datatablePT table-light table-hover pt-3">
                            <thead class="">
                                <tr>
                                    <th style="white-space: nowrap">
                                        Id
                                    </th>
                                    <th style="white-space: nowrap">
                                        Proprietário
                                    </th>
                                    <th style="white-space: nowrap">
                                        Título do áudio
                                    </th>
                                    <th style="white-space: nowrap">
                                        Participação
                                    </th>
                                    <th style="white-space: nowrap">
                                        Estilo
                                    </th>
                                    <th style="white-space: nowrap">
                                        Data da gravação
                                    </th>
                                    <th style="white-space: nowrap">
                                        Estado
                                    </th>
                                    <th style="white-space: nowrap">
                                        Duração
                                    </th>
                                    <th style="white-space: nowrap">
                                        Agendado
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="">
                                @foreach ($listaGravacao as $item)
                                    <tr>
                                        <td style="white-space: nowrap">{{ $item->id }}</td>
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
                                        <td style="min-width: 200px">{{ $item->titulo_audio }}</td>
                                        <td style="min-width: 200px">
                                            @php
                                                $todosParticipantes = $this->buscarParticipantesGravacao($item->id);
                                                $particEscolhidos = $this->cortarUltimavirgula($todosParticipantes);
                                            @endphp

                                            {{ $particEscolhidos ? 'Feat. ( ' . $particEscolhidos . ' )' : 'Nenhum' }} 
                                        </td>
                                        <td style="white-space: nowrap">
                                            {{ $this->buscarEstilos($item->estilo_audio) ? $this->buscarEstilos($item->estilo_audio)->tipo : '' }}
                                        </td>
                                        <td style="white-space: nowrap">{{ $item->data_gravacao }}</td>
                                        <td style="white-space: nowrap">{{ ucwords($item->estado_gravacao)}}</td>
                                        <td style="white-space: nowrap">{{ $item->duracao }}</td>
                                        <td style="white-space: nowrap">{{ $this->formatarData($item->created_at) }}</td>
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

