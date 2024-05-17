@if ($dadosUtilizador->tipo_acesso != 3)
    <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="modal" data-bs-target="#modalNotificacao">
            <i class="bi bi-bell"></i>
            @if (session('agendamentoEmProcesso'))
                <span class="badge bg-primary badge-number text-primary">.</span>
            @endif
        </a>
    </li>
@endif
