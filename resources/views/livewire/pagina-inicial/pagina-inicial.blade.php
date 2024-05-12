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
                @livewire('pagina-inicial.card-registros')
            </div>

            <div class="col-lg-4">
                @livewire('pagina-inicial.actividades-recentes')

                @if ($utilizadorLogado->tipo_acesso != 3)
                    @livewire('pagina-inicial.grafico-geral')
                @endif
            </div>
        </section>
    </main>
</div>
