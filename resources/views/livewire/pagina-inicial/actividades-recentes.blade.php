<div class="card-body">
    <h5 class="card-title">Actividades Recentes <span>|
            {{ session('paginaActividades') ? session('paginaActividades') : 'Todas' }} </span>
    </h5>
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

        @include('livewire.pagina-inicial.btnPaginacaoActividades')
    </div>
</div>