<li class="nav-item dropdown pe-3 ">
    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        @if ($fotoUtilizador)
            <img src="{{ asset('assets/' . $fotoUtilizador->caminho_arquivo) }}" class="rounded-circle"
                alt="foto" style="width: 40px; height: 40px; object-fit: cover;">
        @else
            <img src="{{ asset('assets/img/img_default.jpg') }}" alt="foto"
                style="width: 40px; height: 40px; object-fit: cover;">
        @endif
        <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('utilizador') }}</span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
            <h6>{{ session('utilizador') }}</h6>
            <span>{{ ucwords($dadosUtilizador->buscarTipoAcesso->tipo) }}</span>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('utilizador.perfil') }}">
                <i class="bi bi-person"></i>
                <span>Perfil</span>
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('utilizador.perfil') }}">
                <i class="bi bi-gear"></i>
                <span>Configurações</span>
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('info.ajuda') }}">
                <i class="bi bi-question-circle"></i>
                <span>Ajuda</span>
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center"
                href="{{ route('utilizador.terminar_sessao') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Terminar Sessão</span>
            </a>
        </li>

    </ul>
</li>