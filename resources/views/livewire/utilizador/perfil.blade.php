<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Perfil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Utilizador</li>
                    <li class="breadcrumb-item active">Perfil & Configurações</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    @php
                        $utilizador = $this->buscarDadosUtilizador($utilizador_id);
                        $dadosPessoais = $this->buscarDadosPessoais($utilizador->id);
                        $redesSociais = $this->buscarRedesSociais($utilizador->id);
                        $acesso = $this->buscarTipoAcesso($utilizador->tipo_acesso);
                        $nascimento = $this->buscarNascimento($dadosPessoais->nascimento);
                        $foto = $this->buscarFotoPerfil($utilizador_id);
                    @endphp

                    @include('livewire.utilizador.perfil-inclusao.foto-redes')
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link {{ $tabVisaoGeral }}" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Visão Geral</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link {{ $tabEditarPerfil }}" data-bs-toggle="tab"
                                        data-bs-target="#profile-edit">Editar
                                        Perfil</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link {{ $tabEditarPasse }}" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Alterar Palavra-passe</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">
                                @include('livewire.utilizador.perfil-inclusao.visao-geral')
                                @include('livewire.utilizador.perfil-inclusao.editar-perfil')
                                @include('livewire.utilizador.perfil-inclusao.palavra-passe')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
