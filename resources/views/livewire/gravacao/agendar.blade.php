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
                                <option class="d-none" selected>Escolha o cliente</option>
                                <option class="">Desconhecido</option>
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
                                        <option class="d-none" selected>Selecione o grupo</option>
                                        <option class="">Desconhecido</option>
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
                                <input type="text" wire:model="termoPesquisa" placeholder="Pesquisar participante...">

                                <table class="table table-hover table-light">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                Id
                                            </th>
                                            <th>
                                                Nome do Particiapante
                                            </th>
                                            <th class="d-none">
                                                Criado em
                                            </th>
                                            <th class="d-none">
                                                Actualizado
                                            </th>
                                            <th>
                                                Participação
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="">
                                        @foreach ($participantesFiltrados as $item)
                                            @php 
                                                $ehEscolhido = in_array($item->id, array_column($participantesEscolhidos, 'id')); 
                                            @endphp
                                            @if (!$ehEscolhido)
                                                <tr>
                                                    <th>{{ $item->id }}</th>
                                                    <th>{{ $item->nome }}</th>
                                                    <th class="d-none">{{ $item->created_at }}</th>
                                                    <th class="d-none">{{ $item->updated_at }}</th>
                                                    <th>
                                                        <input type="checkbox" value="{{ $item->id }}" wire:model="participantesEscolhidos.{{ $item->id }}">
                                                    </th>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                {{ $participantesFiltrados->links() }}

                                <p>
                                    Participantes: 
                                    @foreach ($participantesEscolhidos as $participante)
                                    {{  $this->buscarNomeParticipante($participante)}}
                                @endforeach
                                </p>

                            </div>
                        </div>

                        {{-- Dados do Agendamento --}}
                        <div class="card card-animated p-4 ">
                            <div class="col d-table d-md-flex justify-content-between">
                                <div class="col m-3">
                                    <div class="row g-3">
                                        <label class="text-primary fw-bold" for="">Título do Audio</label> <br>
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
                                        <input type="datetime-local" name="" id=""
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
                                        Agendar Gravação
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
