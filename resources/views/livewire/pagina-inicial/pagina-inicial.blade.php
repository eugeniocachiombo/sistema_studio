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
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-xxl-4 col-md-6">
                            <div class="card card-animated  info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filtrar</h6>
                                        </li>

                                        <form action="" method="get">
                                            <li><a class="dropdown-item"><input type="radio" name=""
                                                        id="" wire:model='gravacao' value="Hoje"> Hoje</a>
                                            </li>
                                            <li><a class="dropdown-item"><input type="radio" name=""
                                                        id="" wire:model='gravacao' value="Pendentes">
                                                    Pendentes</a></li>
                                            <li><a class="dropdown-item"><input type="radio" name=""
                                                        id="" wire:model='gravacao' value="Concluídas">
                                                    Concluídas</a></li>
                                        </form>
                                    </ul>
                                </div>

                                <div class="card-body ">
                                    <h5 class="card-title">Gravação <span>| {{ $gravacao ? $gravacao : 'Hoje' }}</span>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-mic"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>145</h6>
                                            <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-xxl-4 col-md-6">
                            <div class="card card-animated info-card revenue-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filtrar</h6>
                                        </li>

                                        <form action="" method="get">
                                            <li><a class="dropdown-item"><input type="radio" name=""
                                                        id="" wire:model='mixagem' value="Hoje"> Hoje</a>
                                            </li>
                                            <li><a class="dropdown-item"><input type="radio" name=""
                                                        id="" wire:model='mixagem' value="Pendentes">
                                                    Pendentes</a></li>
                                            <li><a class="dropdown-item"><input type="radio" name=""
                                                        id="" wire:model='mixagem' value="Concluídas">
                                                    Concluídas</a></li>
                                        </form>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Mixagem <span>| {{ $mixagem ? $mixagem : 'Hoje' }}</span>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-soundwave"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>3264</h6>
                                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xxl-4 col-xl-12">
                            <div class="card card-animated info-card customers-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filtrar</h6>
                                        </li>

                                        <form action="" method="get">
                                            <li><a class="dropdown-item"><input type="radio" name=""
                                                        id="" wire:model='masterizacao' value="Hoje">
                                                    Hoje</a>
                                            </li>
                                            <li><a class="dropdown-item"><input type="radio" name=""
                                                        id="" wire:model='masterizacao' value="Pendentes">
                                                    Pendentes</a></li>
                                            <li><a class="dropdown-item"><input type="radio" name=""
                                                        id="" wire:model='masterizacao' value="Concluídas">
                                                    Concluídas</a></li>
                                        </form>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Masterização <span>|
                                            {{ $masterizacao ? $masterizacao : 'Hoje' }}</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-speaker"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>1244</h6>
                                            <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">decrease</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card card-animated">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filtrar</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Hoje</a></li>
                                        <li><a class="dropdown-item" href="#">Este mês</a></li>
                                        <li><a class="dropdown-item" href="#">Este ano</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Gráfico de serviços <span>| Hoje</span></h5>
                                    <div id="reportsChart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                    name: 'Gravação',
                                                    data: [31, 40, 28, 51, 42, 82, 56],
                                                }, {
                                                    name: 'Mixagem',
                                                    data: [11, 32, 45, 32, 34, 52, 41]
                                                }, {
                                                    name: 'Masterização',
                                                    data: [15, 11, 32, 18, 9, 24, 11]
                                                }],
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'datetime',
                                                    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                                                        "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                                                        "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                                                        "2018-09-19T06:30:00.000Z"
                                                    ]
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'dd/MM/yyyy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>

                        {{-- Clientes --}}
                        @if ($utilizadorLogado->tipo_acesso != 3)
                            <div class="col-12">
                                    @livewire('pagina-inicial.tb-clientes')
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    @livewire('pagina-inicial.actividades-recentes')
                    @livewire('pagina-inicial.grafico-geral')
                </div>
            </div>
        </section>
    </main>
</div>
