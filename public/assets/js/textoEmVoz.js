document.addEventListener('livewire:load', function () {
    Livewire.on('textoEmVoz', (texto) => {
       /* const synthesis = window.speechSynthesis;
        const utterance = new SpeechSynthesisUtterance(texto);
        synthesis.speak(utterance);*/
    });
});