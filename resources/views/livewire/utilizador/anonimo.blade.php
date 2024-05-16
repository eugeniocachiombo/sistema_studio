<div>
    @php
        $utilizador = $this->buscarDadosUtilizador($utilizador_id);
        $dadosPessoais = $this->buscarDadosPessoais($utilizador->id);
        $acesso = $this->buscarTipoAcesso($utilizador->tipo_acesso);
        $nascimento = $this->buscarNascimento($dadosPessoais->nascimento);
        $foto = $this->buscarFotoPerfil($utilizador_id);
    @endphp
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Perfil do {{ucwords($acesso->tipo)}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ucwords($acesso->tipo)}}</li>
                    <li class="breadcrumb-item active">Perfil</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
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
                            </ul>

                            <div class="tab-content pt-2">
                                @include('livewire.utilizador.perfil-inclusao.visao-geral')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
