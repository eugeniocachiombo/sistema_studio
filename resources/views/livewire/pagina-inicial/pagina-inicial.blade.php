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
                    @livewire('pagina-inicial.card-registros')

                    @livewire('pagina-inicial.grafico-servico')
                </div>

                <div class="col-lg-4 ">
                    @livewire('pagina-inicial.actividades-recentes')
                </div>
            </div>

            <div class="row">
                @if ($utilizadorLogado->tipo_acesso != 3)
                    @if ($utilizadorLogado->tipo_acesso == 1)
                        <div class="col-lg-4">
                            @livewire('pagina-inicial.grafico-geral')
                        </div>

                        <div class="col-lg-8">
                            @livewire('pagina-inicial.tb-clientes')
                        </div>
                    @else
                        <div class="col-12">
                            @livewire('pagina-inicial.tb-clientes')
                        </div>
                    @endif
                @endif
            </div>
        </section>
    </main>
</div>
