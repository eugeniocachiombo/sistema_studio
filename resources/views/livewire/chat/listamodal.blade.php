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
                                    /*$criptUtilizador_id = Crypt::encrypt($utilizador_id);
 $criptIdRemente = Crypt::encrypt($idRemente);*/
                                @endphp

                                @if ($conversa->estado == 'pendente' && $conversa->receptor == $utilizador_id)
                                    <a id="bgMsg"
                                        class="bg-secondary pt-1 d-flex justify-content-center align-items-center"
                                        href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                                        style="border-radius: 50px">

                                        <div class="col-4 text-center mt-2 mb-3 ">
                                            @php
                                                $foto = $this->buscarFotoPerfil($idRemente);
                                            @endphp
                                            @if ($foto)
                                                <img src="{{ url('storage/' . $foto->caminho_arquivo) }}"
                                                    class="rounded-circle me-2" alt="foto"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/img_default.jpg') }}" class="me-2"
                                                    alt="foto"
                                                    style="border-radius: 13px; width: 100px; height: 100px; object-fit: cover;">
                                            @endif
                                        </div>

                                        <div class="col-6 ">
                                            <b><h5 class="text-light" style="white-space: nowrap;">{{ $nome }}
                                            </h5></b>
                                            <p class="text-light w-100" >
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

                                        <div class="col-2 text-light text-center ">
                                            <h4><span
                                                    class="badge badge-lg bg-danger">{{ count($this->msgPendentes()) }}</span>
                                            </h4>
                                        </div>
                                    </a>
                                @else
                                    <a id="bgMsg" 
                                        class="bg-white pt-1 d-flex justify-content-center align-items-center"
                                        href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                                        style="border-radius: 50px">

                                        <div class="col-4 text-center mt-2 mb-3 ">
                                            @php
                                                $foto = $this->buscarFotoPerfil($idRemente);
                                            @endphp
                                            @if ($foto)
                                                <img src="{{ url('storage/' . $foto->caminho_arquivo) }}"
                                                    class="rounded-circle me-2" alt="foto"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/img_default.jpg') }}" class="me-2"
                                                    alt="foto"
                                                    style="border-radius: 13px; width: 100px; height: 100px; object-fit: cover;">
                                            @endif
                                        </div>

                                        <div class="col-6">
                                            <b><h5 class="text-dark" style="white-space: nowrap;">{{ $nome }}
                                            </h5></b>
                                            <p class="text-dark pe-2 w-100" style="white-space: nowrap;">
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

                                        <div class="col-2 text-center">
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
