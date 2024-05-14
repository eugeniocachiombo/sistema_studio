<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Masterização</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Masterização</a></li>
                    <li class="breadcrumb-item active">Concluir</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <div class="card card-animated p-4">
                <div class="col ">
                    <label class="text-primary fw-bold" for="">Lista de Masterizações Agendadas</label> <br>
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
                                        Data da Masterizacao
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
                                @foreach ($listaGravacoes as $item)
                                    @php
                                        $proprietario = '';
                                        $idGravacao = $item->id;
                                        $todosParticipantes = $this->buscarParticipantesGravacao($idGravacao);
                                        $particEscolhidos = $this->cortarUltimavirgula($todosParticipantes);
                                        $cliente = $this->buscarUtilizador($item->cliente_id);
                                        $dadosMixagem = $this->buscarDadosMixagem($idGravacao);
                                        $dadosMasterizacao = $this->buscarDadosMasterizacao($dadosMixagem->id);
                                    @endphp
                                    <tr>
                                        <td class="bg-success text-white text-center" style="white-space: nowrap">
                                            {{ $item->id }}</td>
                                        <td style="white-space: nowrap">
                                            <div class="d-flex">
                                                <div>
                                                    @if ($item->cliente_id)
                                                    @php
                                                        $proprietario = $cliente->name;
                                                        $fotoUtilizador = $this->buscarFotoPerfil($cliente->id);
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
                                                            $proprietario = $this->buscarGrupo($item->grupo_id)->nome . ' (Grupo)';
                                                        @endphp
                                                    @endif

                                                </div>
                                                <div class="d-flex align-items-center ms-1 text-primary">
                                                    {{ $proprietario }}</div>
                                            </div>
                                        </td>
                                        <td style="min-width: 200px">{{ $item->titulo_audio }}</td>
                                        <td style="min-width: 200px">
                                            {{ $particEscolhidos ? ' ( feat. ' . $particEscolhidos . ' )' : 'Nenhuma' }}
                                        </td>
                                        <td class="bg-success text-white" style="white-space: nowrap">
                                            {{ $this->buscarEstilos($item->estilo_audio) ? $this->buscarEstilos($item->estilo_audio)->tipo : '' }}
                                        </td>
                                        <td style="white-space: nowrap">{{ $this->formatarDataNormal($item->data_master) }}</td>
                                        <td style="white-space: nowrap">
                                            @if ($dadosMasterizacao->estado_master == 'masterizado')
                                                <span class="badge bg-success text-light ">
                                                    {{ ucwords($dadosMasterizacao->estado_master) }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger text-light ">
                                                    {{ ucwords($dadosMasterizacao->estado_master) }}
                                                </span>
                                            @endif
                                        </td>
                                        
                                        @if ($dadosMasterizacao->estado_master == 'masterizado')
                                            <td style="white-space: nowrap">
                                                {{ $this->formatarData($dadosMasterizacao->updated_at) }}
                                            </td>
                                        @else
                                            <td style="white-space: nowrap">
                                                --
                                            </td>
                                        @endif

                                        <td style="white-space: nowrap" class="text-center">
                                            @if ($dadosMasterizacao->estado_master == 'masterizado')
                                                <i class="bi bi-check text-success display-6 "></i>
                                            @else
                                                <button class="btn btn-success"
                                                    wire:click="concluirAgendamento({{ $dadosMasterizacao->id }})">
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
