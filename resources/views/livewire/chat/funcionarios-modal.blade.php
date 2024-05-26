<div>
    @if (session('utilizador'))
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
                            @include('livewire.chat.func-inc.lista-msg')
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
