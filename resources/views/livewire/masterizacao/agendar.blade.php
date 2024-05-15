<div>
    <main id="main" class="main">
         <div class="pagetitle">
            <h1>Masterização</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Masterização</a></li>
                    <li class="breadcrumb-item active">Agendamento</li>
                </ol>
            </nav>
        </div> 

         <section class="section contact">
            <form>
                <div class="row gy-4">
                    {{-- Coluna 1 --}}
                    <div class="col">
                        {{-- Cliente --}}
                        <div class="card card-animated p-4">
                            <label class="text-primary fw-bold" for="">Mixagem</label>
                            <select class="form-control mt-3" wire:model="gravacao_id" name="" id="">
                                <option class="d-none">Selecione a mixagem</option>
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
                                                    masterização</label>
                                                <br>
                                                <input type="datetime-local" min="{{$dataMin}}" name="" id=""
                                                    class="form-control" wire:model="dataMasterizacao">

                                           
                                            <div class="text-danger" style="font-size: 12.5px">
                                                @error('dataMasterizacao')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col m-3">
                                            <label class="text-primary fw-bold" for="">Duração da
                                                masterização</label>
                                            <select class="form-control " wire:model="duracaoMasterizacao" name=""
                                                id="">
                                                <option class="d-none">Selecione a duração</option>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i . ' hr' }}">{{ $i . ' hr' }}</option>
                                                @endfor
                                            </select>
                                            <div class="text-danger" style="font-size: 12.5px">
                                                @error('duracaoMasterizacao')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col ">
                                        <div class="col mb-3 ms-3">
                                            <button wire:click.prevent="agendarMasterizacao" class="btn btn-primary">
                                                Agendar 
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
