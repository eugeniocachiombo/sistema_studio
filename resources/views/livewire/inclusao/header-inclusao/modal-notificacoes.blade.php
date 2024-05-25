<div class="card">
    <div class="card-body">
        <div class="modal fade" id="modalNotificacao" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <ul type="none" class=" dropdown-menu-arrow notifications">
                            <li class="notification-item">
                                @if ($agendaEmProrocesso)
                                    <div style="white-space: nowrap;""
                                        class="text-dark pt-4 mb-3">
                                        <h4>Agendamento em Processo <i
                                                class="bi bi-exclamation-circle text-warning"></i></h4>
                                        <span class="text-dark"><b>Proprietário:</b>
                                            {{ $agendaEmProrocesso->buscarCliente->name }}</span> <br>
                                        <span class="text-dark"><b>Título:</b>
                                            {{ $agendaEmProrocesso->titulo_audio }}</span> <br>
                                        <span class="text-dark"><b>Tipo de Agendamento:</b>
                                            {{ $tipoAgendamento }}</span> <br>
                                        <span class="text-dark"><b>Agendado:</b>
                                            {{ $this->formatarData($agendado) }}</span> <br>
                                        <span class="text-dark"><b>Início:</b> {{ $data }}</span>
                                        <br>
                                        <span class="text-dark"><b>Término:</b> {{ $fimAgendaEmProcesso }}</span>
                                    </div>
                                    @else
                                    <b>Nenhum agendamento em processo</b>
                                    @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
