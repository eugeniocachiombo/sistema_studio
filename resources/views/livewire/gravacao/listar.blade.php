@section('titulo', 'Listagem de agendamentos de gravação')
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

                        <table class="table datatablePT table-hover pt-3">
                            <thead class="">
                                <tr>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Id
                                    </th>
                                    <th class="bg-primary text-white" style="white-space: nowrap">
                                        Música
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

                                    <th class="bg-primary text-white text-center" style="white-space: nowrap">
                                        Acção
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="">
                                @foreach ($listaGravacao as $item)
                                    <tr>
                                        <td class="bg-primary text-white text-center" style="white-space: nowrap">
                                            {{ $item->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div style="white-space: nowrap">
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
                                                            $proprietario =
                                                                $this->buscarGrupo($item->grupo_id)->nome . ' (Grupo)';
                                                        @endphp
                                                        <div class="d-flex align-items-center ms-1 text-primary">
                                                            {{ $proprietario }}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div style="white-space: nowrap" class="ps-2">
                                                    - {{ $item->titulo_audio }}
                                                </div>
                                            </div>

                                            <div style="white-space: no-wrap">
                                                @php
                                                    $idGravacao = $item->id;
                                                    $todosParticipantes = $this->buscarParticipantesGravacao(
                                                        $idGravacao,
                                                    );
                                                    $particEscolhidos = $this->cortarUltimavirgula($todosParticipantes);
                                                @endphp

                                                <b>{{ $particEscolhidos ? ' ( Feat. ' . $particEscolhidos . ' )' : '' }}</b>
                                            </div>
                                        </td>
                                        <td style="white-space: nowrap">
                                            {{ $this->buscarEstilos($item->estilo_audio) ? $this->buscarEstilos($item->estilo_audio)->tipo : '' }}
                                        </td>
                                        <td style="white-space: nowrap">
                                            {{ $this->formatarDataNormal($item->data_gravacao) }}</td>
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

                                        <td class="text-center" style="white-space: nowrap">
                                            <button wire:click="buscarListaGravacaoModal({{ $item->id }})"
                                                class="btn btn-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                            @if ($this->buscarUtilizador($idUtilizadorLogado)->tipo_acesso != 3)
                                                <a href="{{ route('gravacao.actualizar', [$idGravacao]) }}">
                                                    <button class="btn btn-success">
                                                        <i class="bi bi-pen"></i>
                                                    </button>
                                                </a>
                                            @endif

                                            @if ($this->buscarUtilizador($idUtilizadorLogado)->tipo_acesso == 1)
                                                <button class="btn btn-danger"
                                                    wire:click.prevent="cancelarAgendamento({{ $idGravacao }})">
                                                    <i class="bi bi-dash-circle"></i>
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
    @include('livewire.gravacao.modal.lista-modal')
</div>
