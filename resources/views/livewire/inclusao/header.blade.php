<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
            </a>
        </li>

        @if (session('utilizador'))
            @php
                $dadosUtilizador = $this->buscarDadosUtilizador($utilizador_id);
                $fotoUtilizador = $this->buscarFotoPerfil($utilizador_id);
            @endphp

            @include('livewire.inclusao.header-inclusao.notificacao')
            @include('livewire.inclusao.header-inclusao.mensagem')
            @include('livewire.inclusao.header-inclusao.dados-utilizador')
        @endif
    </ul>
</nav>
