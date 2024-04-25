const urlParametro = new URLSearchParams(window.location.search);
const valorPagina = urlParametro.get('pagina');

setInterval(function() {
    if(valorPagina == 1 || valorPagina == null){
        Livewire.emit('actividadesRecentesTempoReal');
        window.history.pushState({}, '', '/pagina_inicial');
    }
}, 5000); 
