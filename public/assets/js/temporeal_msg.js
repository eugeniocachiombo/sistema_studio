
const urlParametro = new URLSearchParams(window.location.search);
const valorPagina = urlParametro.get('pagina');
setInterval(function() {
    if(valorPagina == 1 || valorPagina == null){
        Livewire.emit('tempoRealMensagens');
    }
}, 1000); 