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
                <a class="nav-link collapsed" data-bs-target="#gravacao-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-mic"></i><span>Gravação</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="gravacao-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('gravacao.agendar') }}">
                            <i class="bi bi-circle"></i><span>Agendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="mixagem-elements.html">
                            <i class="bi bi-circle"></i><span>Alterar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gravacao.listar') }}">
                            <i class="bi bi-circle"></i><span>Listar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gravacao.listar') }}">
                            <i class="bi bi-circle"></i><span>Concluir</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Mixagem --}}
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#mixagem-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-soundwave"></i><span>Mixagem</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="mixagem-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="mixagem-elements.html">
                            <i class="bi bi-circle"></i><span>Agendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="mixagem-elements.html">
                            <i class="bi bi-circle"></i><span>Alterar</span>
                        </a>
                    </li>
                    <li>
                        <a href="mixagem-elements.html">
                            <i class="bi bi-circle"></i><span>Listar</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Masterizacao --}}
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#masterizacao-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-speaker"></i><span>Masterização</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="masterizacao-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="masterizacao-elements.html">
                            <i class="bi bi-circle"></i><span>Agendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="masterizacao-elements.html">
                            <i class="bi bi-circle"></i><span>Alterar</span>
                        </a>
                    </li>
                    <li>
                        <a href="masterizacao-elements.html">
                            <i class="bi bi-circle"></i><span>Listar</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Gráficos --}}
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#graficos-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Gráficos</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="graficos-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="graficos-chartjs.html">
                            <i class="bi bi-circle"></i><span>Chart.js</span>
                        </a>
                    </li>
                    <li>
                        <a href="graficos-apexgraficos.html">
                            <i class="bi bi-circle"></i><span>Apexgraficos</span>
                        </a>
                    </li>
                    <li>
                        <a href="graficos-egraficos.html">
                            <i class="bi bi-circle"></i><span>Egraficos</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Músicas --}}
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#musicas-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-music-note-list"></i><span>Músicas</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="musicas-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="musicas-bootstrap.html">
                            <i class="bi bi-circle"></i><span>Bootstrap musicas</span>
                        </a>
                    </li>
                    <li>
                        <a href="musicas-remix.html">
                            <i class="bi bi-circle"></i><span>Remix musicas</span>
                        </a>
                    </li>
                    <li>
                        <a href="musicas-boxmusicas.html">
                            <i class="bi bi-circle"></i><span>Boxmusicas</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Utilizadores --}}
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#utilizadores-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-people"></i><span>Utilizadores</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="utilizadores-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="utilizadores-bootstrap.html">
                            <i class="bi bi-circle"></i><span>Bootstrap musicas</span>
                        </a>
                    </li>
                    <li>
                        <a href="utilizadores-remix.html">
                            <i class="bi bi-circle"></i><span>Remix musicas</span>
                        </a>
                    </li>
                    <li>
                        <a href="utilizadores-boxmusicas.html">
                            <i class="bi bi-circle"></i><span>Boxmusicas</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Acesso --}}
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#acessos-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-lock"></i><span>Acessos</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="acessos-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="acessos-bootstrap.html">
                            <i class="bi bi-circle"></i><span>Bootstrap musicas</span>
                        </a>
                    </li>
                    <li>
                        <a href="acessos-remix.html">
                            <i class="bi bi-circle"></i><span>Remix musicas</span>
                        </a>
                    </li>
                    <li>
                        <a href="acessos-boxmusicas.html">
                            <i class="bi bi-circle"></i><span>Boxmusicas</span>
                        </a>
                    </li>
                </ul>
            </li>
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
