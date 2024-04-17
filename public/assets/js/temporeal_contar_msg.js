document.addEventListener('DOMContentLoaded', function () {
    let intervalId;
    function startInterval() {
        intervalId = setInterval(function () {
            Livewire.emit('headerTempoReal');
        }, 5000);
    }
    startInterval();

    document.getElementById('iconMensagem').addEventListener('click', function () {
        clearInterval(intervalId);
        setTimeout(() => {
            startInterval();
        }, 5000);
    });
});