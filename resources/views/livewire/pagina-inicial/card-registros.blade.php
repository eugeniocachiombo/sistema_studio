<div class="col-xxl-4 col-md-6">
    <div class="card card-animated  info-card sales-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filtrar</h6>
                </li>

                <form action="" method="get">
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='gravacao' value="Hoje"> Hoje</a>
                    </li>
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='gravacao' value="Pendentes">
                            Pendentes</a></li>
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='gravacao' value="Concluidas">
                            Concluídas</a></li>
                </form>
            </ul>
        </div>

        <div class="card-body ">
            <h5 class="card-title">Gravação <span>| {{ $gravacao ? $gravacao : 'Total' }}</span>
            </h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-mic"></i>
                </div>
                <div class="ps-3">
                    <h6>{{ count($totalGravacao) }}</h6>
                    <span class="text-success small pt-1 fw-bold">
                        @if ($utilizadorLogado->tipo_acesso == 3)
                            {{ round($this->buscarPercentagemCliente(count($totalGravacao), $gravacao), 1) . '%' }}
                        @else
                            {{ round($this->buscarPercentagem(count($totalGravacao), $gravacao), 1) . '%' }}
                        @endif
                    </span> <span class="text-muted small pt-2 ps-1">Porcento</span>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="col-xxl-4 col-md-6">
    <div class="card card-animated info-card revenue-card">

        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filtrar</h6>
                </li>

                <form action="" method="get">
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='mixagem' value="Hoje"> Hoje</a>
                    </li>
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='mixagem' value="Pendentes">
                            Pendentes</a></li>
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='mixagem' value="Concluidas">
                            Concluídas</a></li>
                </form>
            </ul>
        </div>

        <div class="card-body">
            <h5 class="card-title">Mixagem <span>| {{ $mixagem ? $mixagem : 'Total' }}</span>
            </h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-soundwave"></i>
                </div>
                <div class="ps-3">
                    <h6>{{ count($totalMixagem) }}</h6>
                    <span class="text-success small pt-1 fw-bold">
                        @if ($utilizadorLogado->tipo_acesso == 3)
                            {{ round($this->buscarPercentagemCliente(count($totalMixagem), $mixagem), 1) . '%' }}
                        @else
                            {{ round($this->buscarPercentagem(count($totalMixagem), $mixagem), 1) . '%' }}
                        @endif
                    </span> <span class="text-muted small pt-2 ps-1">Porcento</span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xxl-4 col-xl-12">
    <div class="card card-animated info-card customers-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filtrar</h6>
                </li>

                <form action="" method="get">
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='masterizacao' value="Hoje">
                            Hoje</a>
                    </li>
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='masterizacao' value="Pendentes">
                            Pendentes</a></li>
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='masterizacao' value="Concluidas">
                            Concluídas</a></li>
                </form>
            </ul>
        </div>

        <div class="card-body">
            <h5 class="card-title">Masterização <span>|
                    {{ $masterizacao ? $masterizacao : 'Total' }}</span></h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-speaker"></i>
                </div>
                <div class="ps-3">
                    <h6>{{ count($totalMasterizacao) }}</h6>
                    <span class="text-danger small pt-1 fw-bold">
                        @if ($utilizadorLogado->tipo_acesso == 3)
                            {{ round($this->buscarPercentagemCliente(count($totalMasterizacao), $masterizacao), 1) . '%' }}
                        @else
                            {{ round($this->buscarPercentagem(count($totalMasterizacao), $masterizacao), 1) . '%' }}
                        @endif
                    </span>
                    <span class="text-muted small pt-2 ps-1">Porcento</span>
                </div>
            </div>
        </div>
    </div>
</div>
