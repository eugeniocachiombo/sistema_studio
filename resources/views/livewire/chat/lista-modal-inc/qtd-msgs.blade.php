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