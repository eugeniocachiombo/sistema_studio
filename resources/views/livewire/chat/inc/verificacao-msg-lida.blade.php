@if ($ultimoEstado == 'lido')
    Visto: <i class="bi bi-check-circle-fill text-primary"></i> &nbsp;
    {{ $this->formatarData($ultimaActualizacao) }}
    <hr>
@endif
