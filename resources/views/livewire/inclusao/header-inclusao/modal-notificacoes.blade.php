<div class="card">
    <div class="card-body">
        <div class="modal fade" id="modalNotificacao" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <ul type="none" class=" dropdown-menu-arrow notifications">
                            <li class="notification-item">
                                @if ($agendaEmProrocesso)
                                    <div style="white-space: nowrap; border-bottom: 2px solid black"
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
                                @endif
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-x-circle text-danger"></i>
                                <div>
                                    <h4>Atque rerum nesciunt</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>1 hr. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <div>
                                    <h4>Sit rerum fuga</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>2 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-info-circle text-primary"></i>
                                <div>
                                    <h4>Dicta reprehenderit</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-footer">
                                <a href="#">Ver todas as notificações</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
