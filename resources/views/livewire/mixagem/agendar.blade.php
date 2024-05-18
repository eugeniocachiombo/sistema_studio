<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Mixagem</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Mixagem</a></li>
                    <li class="breadcrumb-item active">Agendamento</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <form>
                <div class="row gy-4 ">
                    {{-- Coluna 1 --}}
                    <div class="col">
                        {{-- Cliente --}}
                        <div class="card card-animated p-4">
                            <label class="text-primary fw-bold" for="">Gravação</label>
                            <select class="form-control mt-3" wire:model="gravacao_id" name="" id="">
                                <option class="d-none">Selecione a gravação</option>
                                @foreach ($listaGravacoes as $item)
                                    <option value="{{ $item->id }}">
                                        @php
                                            $cliente = $this->buscarUtilizador($item->cliente_id);
                                            $grupo = $this->buscarGrupo($item->grupo_id);
                                            $proprietario = $cliente ? $cliente->name : $grupo->nome;
                                            $todosParticipantes = $this->buscarParticipantesGravacao($item->id);
                                            $particEscolhidos = $this->cortarUltimavirgula($todosParticipantes);
                                        @endphp

                                        {{  $proprietario . ' - ' . $item->titulo_audio }}
                                        {{ $particEscolhidos ? ' ( feat. ' . $particEscolhidos . ' )' : '' }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="text-danger" style="font-size: 12.5px">
                                @error('gravacao_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Coluna 3 --}}
                    <div class="col-12">
                        {{-- Dados do Agendamento --}}
                        <div class="card card-animated">
                            <div class="container">
                                <div class="row">
                                    <div class="col m-3">
                                        <div class="row">
                                            <label class="text-primary fw-bold" for="">Agendamento</label> <br>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col d-table d-md-flex justify-content-between">
                                        <div class="col m-3">
                                                <label class="text-primary fw-bold" for="">Data da
                                                    mixagem</label>
                                                <br>
                                                <input type="datetime-local" min="{{$dataMin}}" name="" id=""
                                                    class="form-control" wire:model="dataMixagem">

                                           
                                            <div class="text-danger" style="font-size: 12.5px">
                                                @error('dataMixagem')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col m-3">
                                            <label class="text-primary fw-bold" for="">Duração da
                                                mixagem</label>
                                            <select class="form-control " wire:model="duracaoMixagem" name=""
                                                id="">
                                                <option class="d-none">Selecione a duração</option>
                                                @for ($i = 1; $i <= 4; $i++)
                                                    <option value="{{ $i . ' hr' }}">{{ $i . ' hr' }}</option>
                                                @endfor
                                            </select>
                                            <div class="text-danger" style="font-size: 12.5px">
                                                @error('duracaoMixagem')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col ">
                                        <div class="col mb-3 ms-3">
                                            @if (date('H') > '07' && date('H') <= '18')
                                            @endif
                                            <button wire:click.prevent="agendarMixagem" class="btn btn-primary">
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
                    </div>
            </form>
        </section>
    </main>
</div>
