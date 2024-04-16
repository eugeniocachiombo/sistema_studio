{{-- Apresentar informações do utilizador logado --}}

<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
            </a>
        </li>

        @if (session('utilizador'))
            <!-- Notificacao-->
                @php
                    $dadosUtilizador = $this->buscarDadosUtilizador($utilizador_id);
                @endphp

                @if ($dadosUtilizador->tipo_acesso != 3)
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-primary badge-number">4</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header">
                                Você tem 4 notificações
                                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Ver todas</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    <h4>Lorem Ipsum</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>30 min. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
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
                    </li>
                @endif
            <!-- FIM Notificacao-->

            <!-- Mensagem -->
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    @php
                        $participantesPendentes = $this->totalParticipantesPendentes();
                    @endphp
                    @if (count($participantesPendentes) > 0)
                        <span class="badge bg-success badge-number">
                            {{ count($participantesPendentes) }}
                        </span>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        @if (count($this->msgPendentesGeral()) > 0)
                            @if (count($this->msgPendentesGeral()) == 1)
                                Você tem {{ count($this->msgPendentesGeral()) }} mensagem não lida
                            @else
                                Você tem {{ count($this->msgPendentesGeral()) }} mensagens não lidas
                            @endif
                        @else
                            Você não tem novas mensagens
                        @endif
                        <a href="#" data-bs-toggle="modal" data-bs-target="#scrollingModalFuncionarios"><span class="badge rounded-pill bg-primary p-2 ms-2">Em que podemos ajudar?</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <style>
                        #bgMsg {
                            text-decoration: none;
                            background: rgb(194, 194, 194);
                        }

                        #bgMsg:hover {
                            background: gray;
                        }
                    </style>

                    @for ($i = 0; $i < count($this->listaParticipantes); $i++)
                        @if ($i < 3)
                            <li class="message-item m-1" id="bgMsg">
                                @php
                                    $idRemente = $this->listaParticipantes[$i];
                                    $nome = $this->buscarNomeUsuario($idRemente);
                                    $conversa = $this->ultimaMensagem($idRemente);
                                    /*$criptUtilizador_id = Crypt::encrypt($utilizador_id);
                                    $criptIdRemente = Crypt::encrypt($idRemente);*/
                                @endphp

                                @if ($conversa->estado == 'pendente' && $conversa->receptor == $utilizador_id)
                                    <a id="bgMsgPendente"
                                        class="bg-secondary pt-1 d-flex justify-content-center align-items-center"
                                        href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                                        style="border-radius: 50px">
                                        <div class="col-2">
                                            <img src="{{ asset('assets/img/messages-1.jpg') }}" alt=""
                                                class="rounded-circle">
                                        </div>

                                        <div class="col ms-1">
                                            <h4 class="text-light" style="white-space: nowrap;">{{ $nome }}
                                            </h4>
                                            <p class="text-light">
                                                @if ($conversa->caminho_arquivo != '' && $conversa->tipo_arquivo != '')
                                                    @switch($conversa->tipo_arquivo)
                                                        @case('img')
                                                            <b>Arquivo de Foto</b>
                                                        @break

                                                        @case('audio')
                                                            <b>Arquivo de Áudio</b>
                                                        @break

                                                        @case('texto')
                                                            <b>Arquivo de Texto</b>
                                                        @break

                                                        @default
                                                    @endswitch
                                                @else
                                                    @if (strlen(Crypt::decrypt($conversa->mensagem)) < 25)
                                                        {{ Crypt::decrypt($conversa->mensagem) }}
                                                    @else
                                                        {{ substr(Crypt::decrypt($conversa->mensagem), 0, 30) }}...
                                                    @endif
                                                @endif
                                            </p>
                                            <p class="text-light">
                                                {{ $this->formatarData($conversa->created_at) }}
                                            </p>
                                        </div>

                                        <div class="col text-light text-center">
                                            <span class="badge bg-danger">{{ count($this->msgPendentes()) }}</span>
                                        </div>
                                    </a>
                                @else
                                    <a id="bgMsgLido"
                                        class=" bg-white pt-1 d-flex justify-content-center align-items-center"
                                        href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                                        style="border-radius: 50px">
                                        <div class="col-2">
                                            <img src="{{ asset('assets/img/messages-1.jpg') }}" alt=""
                                                class="rounded-circle">
                                        </div>

                                        <div class="col ms-1">
                                            <h4 class="text-dark" style="white-space: nowrap;">{{ $nome }}
                                            </h4>
                                            <p class="text-dark">
                                                @if ($conversa->caminho_arquivo != '' && $conversa->tipo_arquivo != '')
                                                    @switch($conversa->tipo_arquivo)
                                                        @case('img')
                                                            <b>Arquivo de Foto</b>
                                                        @break

                                                        @case('audio')
                                                            <b>Arquivo de Áudio</b>
                                                        @break

                                                        @case('texto')
                                                            <b>Arquivo de Texto</b>
                                                        @break

                                                        @default
                                                    @endswitch
                                                @else
                                                    @if (strlen(Crypt::decrypt($conversa->mensagem)) < 25)
                                                        {{ Crypt::decrypt($conversa->mensagem) }}
                                                    @else
                                                        {{ substr(Crypt::decrypt($conversa->mensagem), 0, 30) }}...
                                                    @endif
                                                @endif
                                            </p>

                                            <p class="text-dark">{{ $this->formatarData($conversa->created_at) }}</p>
                                        </div>

                                        <div class="col text-center">
                                            @if ($conversa->estado == 'lido')
                                                    <i class="bi bi-check-circle-fill text-primary"></i>
                                                @else
                                                    <i class="bi bi-check text-primary"></i>
                                                @endif
                                        </div>
                                    </a>
                                @endif
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endif
                    @endfor

                    <li class="dropdown-footer">
                        @if (count($this->listaParticipantes) > 3)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#scrollingModal">Mostrar todas as
                                mensagens</a>
                        @endif
                    </li>
                </ul>
            </li>

            <!-- Dados utilizador -->
            <li class="nav-item dropdown pe-3 ">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('utilizador') }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ session('utilizador') }}</h6>
                        <span>Web Designer</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('utilizador.perfil') }}">
                            <i class="bi bi-person"></i>
                            <span>Perfil</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('utilizador.perfil') }}">
                            <i class="bi bi-gear"></i>
                            <span>Configurações</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('info.ajuda') }}">
                            <i class="bi bi-question-circle"></i>
                            <span>Ajuda</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('utilizador.terminar_sessao') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Terminar Sessão</span>
                        </a>
                    </li>

                </ul>
            </li>
        @endif
    </ul>
</nav>
