<div>
    <div class="modal fade" id="scrollingModalFuncionarios" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <b>Fale Conosco</b>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="min-height: 1500px;">
                    <style>
                        #bgMsgGeral {
                            text-decoration: none;
                            background: rgb(194, 194, 194);
                        }

                        #bgMsgGeral:hover {
                            background: gray;
                        }
                    </style>

                    <div class="col-12 d-flex flex-column ">
                        @foreach ($listaFuncionarios as $funcionario)
                            <div class="p-3" id="bgMsgGeral">
                                <a id="bgMsg" class="bg-white pt-1 d-flex justify-content-center align-items-center"
                                    href="{{ route('chat.conversa', [$utilizador_id, $funcionario->id]) }}"
                                    style="border-radius: 50px">
                                    <div class="col-4 text-center mt-2 mb-3 ">

                                            @php
                                                $foto = $this->buscarFotoPerfil($funcionario->id);
                                            @endphp
                                            @if ($foto)
                                                
                                                <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                                    class="rounded-circle me-2" alt="foto"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/img_default.jpg') }}"
                                                    alt="foto" 
                                                    style="border-radius: 13px;width: 100px; height: 100px; object-fit: cover;">
                                            @endif
                                    </div>

                                    <div class="col-8">
                                        <b>
                                            <h5 class="text-dark" style="white-space: nowrap;">
                                                <b>{{ $funcionario->name }}</b>
                                            </h5>
                                        </b>
                                        <p class="text-dark pe-2" style="white-space: nowrap;">
                                            @php
                                                $idAcesso = $funcionario->tipo_acesso;
                                                $tipoAcesso = $this->buscarTipoAcesso($idAcesso);
                                            @endphp
                                            Conta de {{ ucwords($tipoAcesso->tipo )}}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
