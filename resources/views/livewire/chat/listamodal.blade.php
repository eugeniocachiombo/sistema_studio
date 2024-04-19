<div>
    <div class="modal fade" id="scrollingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if (count($this->msgPendentesGeral()) > 0)
                            @if (count($this->msgPendentesGeral()) == 1)
                                Você tem {{ count($this->msgPendentesGeral()) }} mensagem não lida
                            @else
                                Você tem {{ count($this->msgPendentesGeral()) }} mensagens não lidas
                            @endif
                        @else
                            Você não tem novas mensagens
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="min-height: 1500px;">
                    <style>
                        #bgMsg {
                            text-decoration: none;
                        }

                        #bgMsg:hover {
                            background: gray;
                        }

                        #bgMsgGeral {
                            text-decoration: none;
                            background: rgb(194, 194, 194);
                        }

                        #bgMsgGeral:hover {
                            background: gray;
                        }
                    </style>

                    <div class="col-12 d-flex flex-column pe-2 ps-2">
                        @for ($i = 0; $i < count($this->listaParticipantes); $i++)
                            <div class="p-3" id="bgMsgGeral">
                                @php
                                    $idRemente = $this->listaParticipantes[$i];
                                    $nome = $this->buscarNomeUsuario($idRemente);
                                    $conversa = $this->ultimaMensagem($idRemente);
                                @endphp

                                @if ($conversa->estado == 'pendente' && $conversa->receptor == $utilizador_id)
                                    <a id="bgMsgPendente"
                                        class="border border-primary bg-secondary pt-1 d-flex justify-content-center align-items-center"
                                        href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                                        style="border-radius: 50px">

                                        <div class="col text-center mt-2 mb-3 me-1 ms-1">
                                            @php
                                                $foto = $this->buscarFotoPerfil($idRemente);
                                            @endphp
                                            @if ($foto)
                                                <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                                    class="rounded-circle " alt="foto"
                                                    style="width: 70px; height: 70px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/img_default.jpg') }}" class=""
                                                    alt="foto"
                                                    style="border-radius: 13px; width: 60px; height: 60px; object-fit: cover;">
                                            @endif
                                        </div>

                                        <div class="col-7 ">
                                            <h4 class="text-light" style="word-wrap: break-word">{{ $nome }}
                                            </h4>
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
                                                    @if (strlen(Crypt::decrypt($conversa->mensagem)) < 25)
                                                        {{ Crypt::decrypt($conversa->mensagem) }}
                                                    @else
                                                        {{ substr(Crypt::decrypt($conversa->mensagem), 0, 30) }}...
                                                    @endif
                                                @endif
                                            </p>
                                            <p class="text-light">{{ $this->formatarData($conversa->created_at) }}
                                            </p>
                                        </div>

                                        <div class="col text-light text-center ">
                                            <h4><span
                                                    class="badge badge-md bg-danger">{{ count($this->msgPendentes()) }}</span>
                                            </h4>
                                        </div>
                                    </a>
                                @else
                                    <a id="bgMsg"
                                        class="border border-primary bg-white pt-1 d-flex justify-content-center align-items-center"
                                        href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                                        style="border-radius: 50px">

                                        <div class="col text-center mt-2 mb-3 me-1 ms-1">
                                            @php
                                                $foto = $this->buscarFotoPerfil($idRemente);
                                            @endphp
                                            @if ($foto)
                                                <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                                    class="rounded-circle" alt="foto"
                                                    style="width: 70px; height: 70px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/img_default.jpg') }}" class="me-2"
                                                    alt="foto"
                                                    style="border-radius: 13px; width: 60px; height: 60px; object-fit: cover;">
                                            @endif
                                        </div>

                                        <div class="col-7">
                                            <b>
                                                <h4 class="text-dark" style="word-wrap: break-word">{{ $nome }}
                                                </h4>
                                            </b>
                                            <p class="text-dark w-100" >
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

                                            <p class="text-dark">{{ $this->formatarData($conversa->created_at) }}
                                            </p>
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

                            </div>
                            <hr>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
