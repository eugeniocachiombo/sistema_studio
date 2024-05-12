<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Painel</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Página Inicial</li>
                    <li class="breadcrumb-item active">Painel</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8 ">
                    <div class="row">
                        @livewire('pagina-inicial.card-registros')
                    </div>

                    @livewire('pagina-inicial.grafico-servico')
                </div>

                <div class="col-lg-4 ">
                    @livewire('pagina-inicial.actividades-recentes')
                </div>
            </div>

            <div class="row">
                @if ($utilizadorLogado->tipo_acesso != 3)
                    <div class="col">
                        @livewire('pagina-inicial.grafico-geral')
                    </div>

                    <div class="col">
                        @livewire('pagina-inicial.tb-clientes')
                    </div>
                @endif
            </div>
        </section>
    </main>
</div>
