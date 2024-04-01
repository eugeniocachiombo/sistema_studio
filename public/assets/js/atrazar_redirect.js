document.addEventListener('livewire:load', function () {
    Livewire.on('atrazar_redirect', function (data) {
        setTimeout(() => {
            window.location = data.caminho
        }, data.tempo);
    });
});