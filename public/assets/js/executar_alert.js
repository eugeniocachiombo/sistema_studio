document.addEventListener('livewire:load', function () {
    Livewire.on('alerta', function (data) {
        Swal.fire({
            icon: data.icon,
            title: data.mensagem,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        });
    });
});