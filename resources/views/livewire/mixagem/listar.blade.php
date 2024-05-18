<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Mixagem</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Mixagem</a></li>
                    <li class="breadcrumb-item active">Listagem</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <div class="card card-animated p-4">
                <div class="col ">
                    <label class="text-primary fw-bold" for="">Lista de Mixagens Agendadas</label> <br>
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
                                        Data da Mixagem
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Estado
                                    </th>

                                    @if ($this->buscarUtilizador($idUtilizadorLogado)->tipo_acesso == 3)
                                        <th class="bg-primary text-white" style="white-space: nowrap">
                                            Concluido
                                        </th>
                                    @endif
                                    
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Duração
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Agendado
                                    </th>

                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Responsavel
                                    </th>

                                    @if ($this->buscarUtilizador($idUtilizadorLogado)->tipo_acesso != 3)
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Editar
                                    </th>
                                    @endif

                                    @if ($this->buscarUtilizador($idUtilizadorLogado)->tipo_acesso == 1)
                                        <th class="bg-primary text-white" style="white-space: nowrap">
                                            Cancelar
                                        </th>
                                    @endif
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
                                    @endphp
                                    <tr>
                                        <td class="bg-primary text-white text-center" style="white-space: nowrap">
                                            {{ $dadosMixagem->id }}</td>
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
                                                            
                                                                <a href="{{ route('utilizador.anonimo', $item->cliente_id) }}">
                                                                    {{ $proprietario }}
                                                                </a>
                                                            
                                                        @elseif($item->grupo_id)
                                                            @php
                                                                $proprietario = $this->buscarGrupo($item->grupo_id)->nome . ' (Grupo)';
                                                            @endphp
                                                            <div class="d-flex align-items-center ms-1 text-primary">
                                                                {{ $proprietario }}
                                                            </div>
                                                        @endif
    
                                                    </div>
                                                </div>
                                            </td>
                                        <td style="min-width: 200px">{{ $item->titulo_audio }}</td>
                                        <td style="min-width: 200px">
                                            {{ $particEscolhidos ? ' ( feat. ' . $particEscolhidos . ' )' : 'Nenhuma' }}
                                        </td>
                                        <td style="white-space: nowrap">
                                            {{ $this->buscarEstilos($item->estilo_audio) ? $this->buscarEstilos($item->estilo_audio)->tipo : '' }}
                                        </td>
                                        <td style="white-space: nowrap">
                                            {{ $this->formatarDataNormal($dadosMixagem->data_mixagem) }}</td>
                                        <td style="white-space: nowrap">
                                            @if ($dadosMixagem->estado_mixagem == 'mixado')
                                                <span class="badge bg-success text-light ">
                                                    {{ ucwords($dadosMixagem->estado_mixagem) }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger text-light ">
                                                    {{ ucwords($dadosMixagem->estado_mixagem) }}
                                                </span>
                                            @endif
                                        </td>

                                        @if ( $this->buscarUtilizador($idUtilizadorLogado)->tipo_acesso == 3)
                                            <td style="white-space: nowrap">
                                                @if ($dadosMixagem->estado_mixagem == 'mixado')
                                                {{ $this->formatarData($dadosMixagem->updated_at) }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                        @endif

                                        <td style="white-space: nowrap">{{ $dadosMixagem->duracao }}</td>
                                        <td style="white-space: nowrap">
                                            {{ $this->formatarData($dadosMixagem->created_at) }}
                                        </td>
                                        <td style="white-space: nowrap">
                                            {{ $this->buscarUtilizador($dadosMixagem->responsavel)->name }}
                                        </td>
                                        @if ($this->buscarUtilizador($idUtilizadorLogado)->tipo_acesso != 3)
                                        <td class="text-center" style="white-space: nowrap">
                                            <a href="{{ route('mixagem.actualizar', [$dadosMixagem->id]) }}">
                                                <button class="btn btn-success">
                                                    <i class="bi bi-pen"></i>
                                                </button>
                                            </a>
                                        </td>
                                        @endif
                                        @if ($this->buscarUtilizador($idUtilizadorLogado)->tipo_acesso == 1)
                                            <td class="text-center" style="white-space: nowrap">
                                                <button class="btn btn-danger"
                                                    wire:click.prevent="cancelarAgendamento({{ $dadosMixagem->id }})">
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
