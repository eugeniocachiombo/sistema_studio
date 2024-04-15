<div>
    <div class="modal fade" id="scrollingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                            @if (count($this->msgPendentesGeral()) > 0)
                                @if (count($this->msgPendentesGeral()) == 1)
                                    Você tem {{ count($this->msgPendentesGeral()) }} nova mensagem
                                @else
                                    Você tem {{ count($this->msgPendentesGeral()) }} novas mensagens
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
                            </style>
        
                            @for ($i = 0; $i < count($this->listaParticipantes); $i++)
                                    <div class="" id="bgMsg">
                                        @php
                                            $idRemente = $this->listaParticipantes[$i];
                                            $nome = $this->buscarNomeUsuario($idRemente);
                                            $conversa = $this->ultimaMensagem($idRemente);
                                            /*$criptUtilizador_id = Crypt::encrypt($utilizador_id);
                                            $criptIdRemente = Crypt::encrypt($idRemente);*/
                                        @endphp
        
                                        @if ($conversa->estado == 'pendente' && $conversa->receptor == $utilizador_id)
                                            <a id="bgMsgPendente"
                                                class="m-2 bg-secondary pt-1 d-flex justify-content-center align-items-center"
                                                href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                                                style="border-radius: 50px">
                                                <div class="col m-2">
                                                    <img src="{{ asset('assets/img/messages-1.jpg') }}" alt=""
                                                        class="rounded-circle">
                                                </div>
        
                                                <div class="col ms-1">
                                                    <h5 class="text-light" style="white-space: nowrap;">{{ $nome }}</h5>
                                                    <p class="text-light">
                                                        @if (strlen(Crypt::decrypt($conversa->mensagem)) < 25)
                                                            {{ Crypt::decrypt($conversa->mensagem) }}
                                                        @else
                                                            {{ substr(Crypt::decrypt($conversa->mensagem), 0, 30) }}...
                                                        @endif
                                                    </p>
                                                    <p class="text-light">{{ $this->formatarData($conversa->created_at) }}</p>
                                                </div>
        
                                                <div class="col text-light text-center">
                                                    <span class="badge bg-danger">{{ count($this->msgPendentes()) }}</span>
                                                </div>
                                            </a> <hr>
                                        @else
                                            <a id="bgMsgLido"
                                                class=" bg-white pt-1 d-flex justify-content-center align-items-center"
                                                href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}"
                                                style="border-radius: 50px">
                                                <div class="ms-2 col-4">
                                                    <img src="{{ asset('assets/img/messages-1.jpg') }}" alt=""
                                                        class="rounded-circle">
                                                </div>
        
                                                <div class="col">
                                                    <h5 class="text-dark" style="white-space: nowrap;">{{ $nome }}</h5>
                                                    <p class="text-dark">
                                                        @if (strlen(Crypt::decrypt($conversa->mensagem)) < 25)
                                                            {{ Crypt::decrypt($conversa->mensagem) }}
                                                        @else
                                                            {{ substr(Crypt::decrypt($conversa->mensagem), 0, 30) }}...
                                                        @endif
                                                    </p>
        
                                                    <p class="text-dark">{{ $this->formatarData($conversa->created_at) }}</p>
                                                </div>
                                            </a> <hr>
                                        @endif
                                    </div>
                            @endfor
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> 
</div>