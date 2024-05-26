<div>
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

    <div class="modal fade" id="scrollingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @include('livewire.chat.lista-modal-inc.qtd-msgs')
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="min-height: 1500px;">
                    <div class="col-12 d-flex flex-column pe-2 ps-2">
                        @include('livewire.chat.lista-modal-inc.msgs')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
