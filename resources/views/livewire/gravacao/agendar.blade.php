<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Gravação</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Gravação</a></li>
                    <li class="breadcrumb-item active">Agendamento</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <form>
                <div class="row gy-4 d-table d-md-flex">
                    {{-- Coluna 1 --}}
                    <div class="col">
                        {{-- Cliente --}}
                        <div class="card card-animated p-4">
                            <label class="text-primary fw-bold" for="">Cliente</label>
                            <select class="form-control" name="" id="" wire:model="cliente_id">
                                <option value="" class="d-none" selected>Escolha o cliente</option>
                                <option value="">Desconhecido</option>
                                @foreach ($listaClientes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" style="font-size: 12.5px">
                                @error('cliente_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Grupo --}}
                        <div class="card card-animated p-4 ">
                            <div class="d-table d-md-flex justify-content-between">
                                <div class="col m-3">
                                    <div class="row g-3">
                                        <label class="text-primary fw-bold" for="">Grupo</label> <br>
                                        <input type="text" name="" id="" class="form-control"
                                            placeholder="Nome do grupo" wire:model="nomeGrupo">
                                        <div class="text-danger" style="font-size: 12.5px">
                                            @error('nomeGrupo')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button wire:click.prevent="criarGrupo" class="btn btn-primary">
                                            Criar
                                        </button>
                                    </div>
                                </div>

                                <div class="col m-3">
                                    <label class="text-primary fw-bold" for="">Escolher</label>
                                    <select class="form-control mt-3" wire:model="grupoEscolhido" name=""
                                        id="">
                                        <option value="" class="d-none">Selecione o grupo</option>
                                        <option value="">Desconhecido</option>
                                        @foreach ($listaGrupos as $item)
                                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger" style="font-size: 12.5px">
                                        @error('grupoEscolhido')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Membros do grupo --}}
                            @if ($tbMembrosGrupo)
                                
                            
                            <div class="col ">
                                {{-- Lista de membros --}}
                                <div class="col-12 card card-animated p-4 d-table d-md-flex">
                                    <label class="text-primary fw-bold" for="">Adicionar Membros ao
                                        grupo</label> <br>
                                    <div class="col table-responsive">
                                        <input type="text" class="form-control mb-3"
                                            wire:model="termoPesquisaMembros" placeholder="Pesquisar cliente (id ou nome)...">

                                        <table class="table table-hover table-light">
                                            <thead class="">
                                                <tr>
                                                    <th>
                                                        Id
                                                    </th>
                                                    <th>
                                                        Foto
                                                    </th>
                                                    <th>
                                                        Nome
                                                    </th>
                                                    <th>
                                                        Selecionar
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="">
                                                @foreach ($listaMembrosClientes as $item)
                                                    <tr>
                                                        <th>{{ $item->id }}</th>
                                                        <th>
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
                                                        </th>
                                                        <th>{{ $item->name }}</th>
                                                        <th>
                                                            <input type="checkbox" value="{{ $item->id }}"
                                                                wire:model="clientesEscolhidos.{{ $item->id }}">
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>

                                        <hr>
                                        <p>
                                            <span class="text-primary fw-bold">Participantes: </span>
                                            @php
                                                $clienteEscolhidos = '';
                                            @endphp
        
                                            @foreach ($clientesEscolhidos as $item)
                                                @php
                                                    $clienteEscolhidos .= $this->buscarNomeCliente($item);
                                                @endphp
                                            @endforeach
        
                                            <span class="text-dark fw-bold">
                                                {{ $clienteEscolhidos = rtrim($clienteEscolhidos, ', ') }}
                                            </span>
                                        </p>
                                        <hr>

                                        <button wire:click.prevent="adicionarMembrosAoGrupo" class="btn btn-primary">
                                            Adicionar Membros
                                        </button>

                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Participante --}}
                        <div class="card card-animated p-4 ">
                            <div class="d-table d-md-flex justify-content-between">
                                <div class="col m-3">
                                    <div class="row g-3">
                                        <label class="text-primary fw-bold" for="">Participante</label> <br>
                                        <input type="text" name="" id="" class="form-control"
                                            wire:model="nomeParticipante" placeholder="Escreva o nome do participante">
                                        <div class="text-danger" style="font-size: 12.5px">
                                            @error('nomeParticipante')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button wire:click.prevent="registarParticipantes"
                                            class="col-6 btn btn-primary">
                                            Registrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Coluna 2 --}}
                    <div class="col">
                        {{-- Lista de participantes --}}
                        <div class="col-12 card card-animated p-4 d-table d-md-flex">
                            <label class="text-primary fw-bold" for="">Lista dos Participantes</label> <br>
                            <div class="col table-responsive">
                                <input type="text" class="form-control mb-3" wire:model="termoPesquisa"
                                    placeholder="Pesquisar participante (id ou nome)...">

                                <table class="table table-hover table-light">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                Foto
                                            </th>
                                            <th>
                                                Participante
                                            </th>
                                            <th>
                                                Selecionar
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="">
                                        @forelse ($participantesFiltrados as $item)
                                            @php
                                                $ehEscolhido = in_array(
                                                    $item->id,
                                                    array_column($participantesEscolhidos, 'id'),
                                                );
                                            @endphp
                                            @if (!$ehEscolhido)
                                                <tr>
                                                    <th>
                                                        @php
                                                            $fotoUtilizador = $this->buscarFotoPerfil($item->user_id);
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
                                                    </th>
                                                    <th>
                                                        {{ $item->nome }}
                                                    </th>
                                                    <th>
                                                        <input type="checkbox" value="{{ $item->id }}"
                                                            wire:model="participantesEscolhidos.{{ $item->id }}">
                                                    </th>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td class="bg-primary text-light" colspan="3">
                                                    Nenhuma informação encontrada
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <p>
                                    <span class="text-primary fw-bold">Participantes: </span>
                                    @php
                                        $particEscolhidos = '';
                                    @endphp

                                    @foreach ($participantesEscolhidos as $participante)
                                        @php
                                            $particEscolhidos .= $this->buscarNomeParticipante($participante);
                                        @endphp
                                    @endforeach

                                    <span class="text-dark fw-bold">
                                        {{ $particEscolhidos = rtrim($particEscolhidos, ', ') }}
                                    </span>
                                </p>
                                <hr>

                            </div>
                        </div>
                    </div>

                    {{-- Coluna 3 --}}
                    <div class="col-12">
                        {{-- Dados do Agendamento --}}
                        <div class="card card-animated">
                            <div class="col d-table d-md-flex justify-content-between">
                                <div class="col m-3">
                                    <div class="row">
                                        <label class="text-primary fw-bold" for="">Agendamento</label> <br>
                                    </div>
                                </div>
                            </div>

                            <div class="col d-table d-md-flex justify-content-between">
                                <div class="col m-3">
                                    <div class="row g-3">
                                        <label class="text-primary fw-bold" for="">Título do Audio</label>
                                        <br>
                                        <input type="text" name="" id="" class="form-control"
                                            placeholder="Escreva o título" wire:model="tituloAudio">
                                    </div>
                                    <div class="text-danger" style="font-size: 12.5px">
                                        @error('tituloAudio')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col m-3">
                                    <label class="text-primary fw-bold" for="">Estilo</label>
                                    <select class="form-control mt-3" wire:model="estilo_id" name=""
                                        id="">
                                        <option class="d-none">Selecione o estilo</option>
                                        @foreach ($listaEstilos as $item)
                                            <option value="{{ $item->id }}">{{ $item->tipo }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger" style="font-size: 12.5px">
                                        @error('estilo_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col d-table d-md-flex justify-content-between">
                                <div class="col m-3">
                                    <div class="row g-3">
                                        <label class="text-primary fw-bold" for="">Data da gravação</label>
                                        <br>
                                        <input type="datetime-local" min="{{$dataMin}}"
                                            class="form-control" wire:model="dataGravacao">
                                    </div>
                                    <div class="text-danger" style="font-size: 12.5px">
                                        @error('dataGravacao')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col m-3">
                                    <label class="text-primary fw-bold" for="">Duração da gravação</label>
                                    <select class="form-control mt-3" wire:model="duracaoGravacao" name=""
                                        id="">
                                        <option class="d-none">Selecione a duração</option>
                                        @for ($i = 1; $i <= 4; $i++)
                                            <option value="{{ $i . ' hr' }}">{{ $i . ' hr' }}</option>
                                        @endfor
                                    </select>
                                    <div class="text-danger" style="font-size: 12.5px">
                                        @error('duracaoGravacao')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col d-table d-md-flex justify-content-between">
                                <div class="col m-3">
                                    <button wire:click.prevent="agendarGravacao" class="btn btn-primary">
                                        Agendar
                                    </button>

                                    <button wire:click.prevent="verRegistroAgendamento" type="button" class="btn btn-success">
                                        Ver Registro
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
</div>
