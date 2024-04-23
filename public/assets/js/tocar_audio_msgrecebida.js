document.addEventListener('livewire:load', function () {
    Livewire.on('somReceberMensagem', caminhoAudio => {
        var audio = new Audio(caminhoAudio);
        audio.play();
    });
});