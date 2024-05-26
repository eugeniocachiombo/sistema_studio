<style>
    #bgMsg {
        text-decoration: none;
        background: rgb(194, 194, 194);
    }

    #bgMsg:hover {
        background: gray;
    }
</style>

<li class="nav-item dropdown">
    <a id="iconMensagem" class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-chat-left-text"></i>
        @if (count($participantesPendentes) > 0)
            <span class="badge bg-success badge-number">
                {{ count($participantesPendentes) }}
            </span>
        @endif
    </a>
    <script src="{{ asset('assets/js/temporeal_contar_msg.js') }}"></script>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header d-table">
            <div>
                @if (count($this->msgPendentesGeral()) > 0)
                    @if (count($this->msgPendentesGeral()) == 1)
                        Você tem {{ count($this->msgPendentesGeral()) }} mensagem não lida
                    @else
                        Você tem {{ count($this->msgPendentesGeral()) }} mensagens não lidas
                    @endif
                @else
                    Você não tem novas mensagens
                @endif
            </div>
            <div class="mt-2">
                <a href="#" data-bs-toggle="modal" data-bs-target="#scrollingModalFuncionarios"><span
                        class="badge rounded-pill bg-primary  p-2 ms-2">Em que podemos ajudar?</span></a>
            </div>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        @for ($i = 0; $i < count($this->listaParticipantes); $i++)
            @if ($i < 3)
                <li class="message-item m-1" id="bgMsg">
                    @php
                        $idRemente = $this->listaParticipantes[$i];
                        $nome = $this->buscarNomeUsuario($idRemente);
                        $conversa = $this->ultimaMensagem($idRemente);
                    @endphp

                    @if ($conversa->estado == 'pendente' && $conversa->receptor == $utilizador_id)
                        <a id="bgMsgPendente"
                            class="border border-primary bg-secondary pt-1 d-flex justify-content-center align-items-center"
                            href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                            style="border-radius: 50px;">
                            <div class="col ">
                                @php
                                    $foto = $this->buscarFotoPerfil($idRemente);
                                @endphp
                                @if ($foto)
                                    <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                        class="rounded-circle" alt="foto"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/img_default.jpg') }}" class=""
                                        alt="foto"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                @endif
                            </div>

                            <div class="col-7 ">
                                <h6 class="text-light" style="word-wrap: break-word">
                                    {{ $nome }}
                                </h6>
                                <p class="text-light w-100">
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
                                        @if (strlen(Crypt::decrypt($conversa->mensagem)) < 15)
                                            {{ Crypt::decrypt($conversa->mensagem) }}
                                        @else
                                            {{ substr(Crypt::decrypt($conversa->mensagem), 0, 15) }}...
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
                            class="border border-primary bg-white pt-1 d-flex justify-content-center align-items-center"
                            href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                            style="border-radius: 50px;">

                            <div class="col ">
                                @php
                                    $foto = $this->buscarFotoPerfil($idRemente);
                                @endphp
                                @if ($foto)
                                    <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                        class="rounded-circle" alt="foto"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/img_default.jpg') }}" class=""
                                        alt="foto"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                @endif
                            </div>

                            <div class="col-7  ">
                                <h4 class="text-dark " style="word-wrap: break-word">
                                    {{ $nome }}
                                </h4>
                                <p class="text-dark w-100 " style="width: inherit">
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
                                        @if (strlen(Crypt::decrypt($conversa->mensagem)) < 15)
                                            {{ Crypt::decrypt($conversa->mensagem) }}
                                        @else
                                            {{ substr(Crypt::decrypt($conversa->mensagem), 0, 15) }}...
                                        @endif
                                    @endif
                                </p>

                                <p class="text-dark">{{ $this->formatarData($conversa->created_at) }}</p>
                            </div>

                            <div class="col text-center ">
                                @if ($conversa->estado == 'lido' && $conversa->emissor != $idRemente)
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