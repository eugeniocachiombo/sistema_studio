<div class="col-lg-8">
    <div class="row">
        <div class="col-xxl-4 col-md-6">
            <div class="card card-animated  info-card sales-card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                            class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filtrar</h6>
                        </li>

                        <form action="" method="get">
                            <li><a class="dropdown-item"><input type="radio" name=""
                                        id="" wire:model='gravacao' value="Hoje"> Hoje</a>
                            </li>
                            <li><a class="dropdown-item"><input type="radio" name=""
                                        id="" wire:model='gravacao' value="Pendentes">
                                    Pendentes</a></li>
                            <li><a class="dropdown-item"><input type="radio" name=""
                                        id="" wire:model='gravacao' value="Concluidas">
                                    Concluídas</a></li>
                        </form>
                    </ul>
                </div>

                <div class="card-body ">
                    <h5 class="card-title">Gravação <span>| {{ $gravacao ? $gravacao : 'Total' }}</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div
                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-mic"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{count($totalGravacao)}}</h6>
                            <span class="text-success small pt-1 fw-bold">12%</span> <span
                                class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-xxl-4 col-md-6">
            <div class="card card-animated info-card revenue-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                            class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filtrar</h6>
                        </li>

                        <form action="" method="get">
                            <li><a class="dropdown-item"><input type="radio" name=""
                                        id="" wire:model='mixagem' value="Hoje"> Hoje</a>
                            </li>
                            <li><a class="dropdown-item"><input type="radio" name=""
                                        id="" wire:model='mixagem' value="Pendentes">
                                    Pendentes</a></li>
                            <li><a class="dropdown-item"><input type="radio" name=""
                                        id="" wire:model='mixagem' value="Concluídas">
                                    Concluídas</a></li>
                        </form>
                    </ul>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Mixagem <span>| {{ $mixagem ? $mixagem : 'Hoje' }}</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div
                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-soundwave"></i>
                        </div>
                        <div class="ps-3">
                            <h6>3264</h6>
                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xxl-4 col-xl-12">
            <div class="card card-animated info-card customers-card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                            class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filtrar</h6>
                        </li>

                        <form action="" method="get">
                            <li><a class="dropdown-item"><input type="radio" name=""
                                        id="" wire:model='masterizacao' value="Hoje">
                                    Hoje</a>
                            </li>
                            <li><a class="dropdown-item"><input type="radio" name=""
                                        id="" wire:model='masterizacao' value="Pendentes">
                                    Pendentes</a></li>
                            <li><a class="dropdown-item"><input type="radio" name=""
                                        id="" wire:model='masterizacao' value="Concluídas">
                                    Concluídas</a></li>
                        </form>
                    </ul>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Masterização <span>|
                            {{ $masterizacao ? $masterizacao : 'Hoje' }}</span></h5>
                    <div class="d-flex align-items-center">
                        <div
                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-speaker"></i>
                        </div>
                        <div class="ps-3">
                            <h6>1244</h6>
                            <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                class="text-muted small pt-2 ps-1">decrease</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @livewire('pagina-inicial.grafico-servico')
        </div>

        {{-- Clientes --}}
        @if ($utilizadorLogado->tipo_acesso != 3)
            <div class="col-12">
                @livewire('pagina-inicial.tb-clientes')
            </div>
            @endif
    </div>
</div>