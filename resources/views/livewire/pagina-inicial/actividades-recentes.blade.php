
    <div class="card card-animated">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                    class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filtrar</h6>
                </li>

                <form action="" method="get">
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='actividadesRecentes' value="Todas">
                            Todas</a>
                    </li>
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='actividadesRecentes' value="Normal">
                            Normal</a></li>
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='actividadesRecentes' value="Alerta">
                            Alerta</a></li>
                    <li><a class="dropdown-item"><input type="radio" name="" id=""
                                wire:model='actividadesRecentes' value="Hoje">
                            Hoje</a></li>
                </form>
            </ul>
        </div>

<div class="card-body">
    <h5 class="card-title">Actividades Recentes <span>|
            {{ session('paginaActividades') ? session('paginaActividades') : 'Todas' }} </span>
    </h5>
    <div class="text-muted mb-3">Último acesso: {{$this->buscarUltimoAcesso($utilizador_id)}}</div>

    <div class="activity">
        @forelse ($todasActividadesUtl as $item)
            <div class="activity-item d-flex">
                <div class="activite-label me-2">{{ $this->formatarData($item->created_at) }}
                </div>
                <i
                    class='bi bi-circle-fill activity-badge {{ $this->corTexto($item->tipo_msg) }} align-self-start'></i>
                <div class="activity-content">
                    <b class="text-primary mb-2">
                        {{ $item->tipo_msg == 'normal' ? $this->buscarNomeUsuario($item->user_id) : '' }}</b>
                    <hr>
                    <i>{!! nl2br($item->mensagem) !!}</i>
                </div>
            </div>
        @empty
            <p class="fw-bold alert alert-info">Nenhuma informação de momento</p>
        @endforelse

        @include('livewire.pagina-inicial.btnPaginacaoActividadesRecentes')
    </div>
</div>
</div>

<script src="{{ asset('assets/js/temporeal_actividades_recentes.js') }}"></script>