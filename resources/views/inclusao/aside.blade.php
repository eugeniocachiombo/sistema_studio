<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (session('utilizador'))
            <li class="nav-item">
                <a class="nav-link " href="{{ route('pagina_inicial.') }}">
                    <i class="bi bi-grid"></i>
                    <span>Painel</span>
                </a>
            </li>

            {{-- Gravação --}}
            <li class="nav-item">
                <a class="nav-link collapsed gravacao-nav" data-bs-target="#gravacao-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-mic"></i><span>Gravação</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="gravacao-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    @if (session('tipo_acesso') != 3)
                        <li>
                            <a href="{{ route('gravacao.agendar') }}">
                                <i class="bi bi-circle"></i><span>Agendar</span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('gravacao.listar') }}">
                            <i class="bi bi-circle"></i><span>Lista</span>
                        </a>
                    </li>

                    @if (session('tipo_acesso') < 2)
                        <li>
                            <a href="{{ route('gravacao.concluir') }}">
                                <i class="bi bi-circle"></i><span>Concluidas</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </li>

            {{-- Mixagem --}}
            <li class="nav-item">
                <a class="nav-link collapsed mixagem-nav" data-bs-target="#mixagem-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-soundwave"></i><span>Mixagem</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="mixagem-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @if (session('tipo_acesso') != 3)
                        <li>
                            <a href="{{ route('mixagem.agendar') }}">
                                <i class="bi bi-circle"></i><span>Agendar</span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('mixagem.listar') }}">
                            <i class="bi bi-circle"></i><span>Listar</span>
                        </a>
                    </li>

                    @if (session('tipo_acesso') < 2)
                        <li>
                            <a href="{{ route('mixagem.concluir') }}">
                                <i class="bi bi-circle"></i><span>Concluir</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            {{-- Masterizacao --}}
            <li class="nav-item">
                <a class="nav-link collapsed masterizacao-nav" data-bs-target="#masterizacao-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-speaker"></i><span>Masterização</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="masterizacao-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @if (session('tipo_acesso') != 3)
                        <li>
                            <a href="{{ route('masterizacao.agendar') }}">
                                <i class="bi bi-circle"></i><span>Agendar</span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('masterizacao.listar') }}">
                            <i class="bi bi-circle"></i><span>Listar</span>
                        </a>
                    </li>

                    @if (session('tipo_acesso') < 2)
                        <li>
                            <a href="{{ route('masterizacao.concluir') }}">
                                <i class="bi bi-circle"></i><span>Concluir</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            {{-- Grupos --}}
            <li class="nav-item">
                <a class="nav-link collapsed grupo-nav" data-bs-target="#grupo-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i><span>Grupos</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="grupo-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @if (session('tipo_acesso') < 3)
                        <li>
                            <a href="{{ route('grupo.criar') }}">
                                <i class="bi bi-circle"></i><span>Criar</span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('grupo.listar') }}">
                            <i class="bi bi-circle"></i><span>Listar</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Estilos --}}
            <li class="nav-item">
                <a class="nav-link collapsed estilos-nav" data-bs-target="#estilos-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-music-note-list"></i><span>Estilos</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="estilos-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @if (session('tipo_acesso') == 1)
                        <li>
                            <a href="{{ route('estilos.adicionar') }}">
                                <i class="bi bi-circle"></i><span>Adicionar</span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('estilos.listar') }}">
                            <i class="bi bi-circle"></i><span>Listar</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Utilizadores --}}
            @if (session('tipo_acesso') == 1)
                <li class="nav-item">
                    <a class="nav-link collapsed utilizador-nav" data-bs-target="#utilizador-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-person"></i><span>Utilizadores</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="utilizador-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('utilizador.listagem.clientes') }}">
                                <i class="bi bi-circle"></i><span>Clientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('utilizador.listagem.atendentes') }}">
                                <i class="bi bi-circle"></i><span>Atendentes</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('utilizador.listagem.todos') }}">
                                <i class="bi bi-circle"></i><span>Todos</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- Acesso --}}
            @if (session('tipo_acesso') == 0)
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#acessos-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-lock"></i><span>Acessos</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="acessos-nav" class="nav-content collapse d-none" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="acessos-bootstrap.html">
                                <i class="bi bi-circle"></i><span>Bootstrap estilos</span>
                            </a>
                        </li>
                        <li>
                            <a href="acessos-remix.html">
                                <i class="bi bi-circle"></i><span>Remix estilos</span>
                            </a>
                        </li>
                        <li>
                            <a href="acessos-boxestilos.html">
                                <i class="bi bi-circle"></i><span>Boxestilos</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif

        <li class="nav-heading">Páginas</li>

        {{-- Apresentar informações de cadastro --}}
        @if (!session('utilizador'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('utilizador.cadastro') }}">
                    <i class="bi bi-card-list"></i>
                    <span>Criar Conta</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('utilizador.autenticacao') }}">
                    <i class="bi bi-box-arrow-in-left"></i>
                    <span>Iniciar Sessão</span>
                </a>
            </li>
        @endif

        {{-- Apresentar Perfil --}}
        @if (session('utilizador'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('utilizador.perfil') }}">
                    <i class="bi bi-person"></i>
                    <span>Perfil</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('info.ajuda') }}">
                <i class="bi bi-question-circle"></i>
                <span>Ajuda</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('info.contacto') }}">
                <i class="bi bi-envelope"></i>
                <span>Contactos</span>
            </a>
        </li>
    </ul>
</aside>

<script src="{{ asset('assets/js/melhorar_menu.js') }}"></script>
