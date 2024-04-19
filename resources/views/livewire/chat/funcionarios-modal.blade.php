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
                                <a id="bgMsg" class="border border-primary bg-white pt-1 d-flex justify-content-center align-items-center"
                                    href="{{ route('chat.conversa', [$utilizador_id, $funcionario->id]) }}"
                                    style="border-radius: 50px">
                                    <div class="col-3 text-center mt-2 mb-3 ms-1 ps-1">

                                            @php
                                                $foto = $this->buscarFotoPerfil($funcionario->id);
                                            @endphp
                                            @if ($foto)
                                                
                                                    <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                                    class="rounded-circle " alt="foto"
                                                    style="width: 70px; height: 70px; object-fit: cover;">
                                                
                                            @else
                                                <img src="{{ asset('assets/img/img_default.jpg') }}"
                                                    alt="foto" 
                                                    style="border-radius: 20px;width: 60px; height: 60px; object-fit: cover;">
                                            @endif
                                    </div>

                                    <div class="col ms-2 text-start">
                                        <div class="text-start text-dark" >
                                                    <b style="overflow: hidden; min-width: 100px;">
                                                        {{ $funcionario->name }} </b>
                                        </div>
                                        <div>
                                            <p class="text-dark " style="white-space: nowrap;">
                                                @php
                                                    $idAcesso = $funcionario->tipo_acesso;
                                                    $tipoAcesso = $this->buscarTipoAcesso($idAcesso);
                                                @endphp
                                                Conta de {{ ucwords($tipoAcesso->tipo )}}
                                            </p>
                                        </div>
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
