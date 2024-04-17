document.addEventListener('DOMContentLoaded', function() {
    var passwordInput = document.getElementById('passeActual');
    var newPasswordInput = document.getElementById('passeNova');
    var renewPasswordInput = document.getElementById('passeConfirmacao');
    function verificarCampos() {
        if (passwordInput.value !== '' && 
            newPasswordInput.value !== '' && 
            renewPasswordInput.value !== '') {
            livewire.restart(); 
        } else {
            livewire.stop(); 
        }
    }
    passwordInput.addEventListener('input', verificarCampos);
    newPasswordInput.addEventListener('input', verificarCampos);
    renewPasswordInput.addEventListener('input', verificarCampos);
});