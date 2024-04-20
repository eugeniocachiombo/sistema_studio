@if(!empty($alertaPasse) && session("alterarPasse") == true)
    @php
        session()->forget("alterarPasse");
        $msg = $alertaPasse['mensagem'];
        $icon = $alertaPasse['icon'];
        $tempo = array_key_exists('tempo', $alertaPasse) ? $alertaPasse['tempo'] : "";
    @endphp

    <script>
        var msg = "<?php echo $msg ?>";
        var icon = "<?php echo $icon ?>";
        var tempo = "<?php echo $tempo ?>";

        Swal.fire({
            icon: icon,
            title: msg,
            showConfirmButton: false,
            timer: tempo ? tempo : 4000
        });
        window.history.pushState({}, '', '/utilizador/perfil');
    </script>
@endif