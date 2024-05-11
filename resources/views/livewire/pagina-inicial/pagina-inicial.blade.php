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
                              <div class="card-body">
                                <h5 class="card-title">Gráfico de Serviços</h5>
                                
                                <div id="columnChart"></div>
                  
                                <script>
                                  document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#columnChart"), {
                                      series: [{
                                        name: 'Gravação',
                                        data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 33, 64, 10]
                                      }, {
                                        name: 'Mixagem',
                                        data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 33, 54, 20]
                                      }, {
                                        name: 'Masterização',
                                        data: [35, 41, 36, 26, 45, 48, 52, 53, 41, 53, 64, 20]
                                      }],
                                      chart: {
                                        type: 'bar',
                                        height: 350
                                      },
                                      plotOptions: {
                                        bar: {
                                          horizontal: false,
                                          columnWidth: '55%',
                                          endingShape: 'rounded'
                                        },
                                      },
                                      dataLabels: {
                                        enabled: false
                                      },
                                      stroke: {
                                        show: true,
                                        width: 2,
                                        colors: ['transparent']
                                      },
                                      xaxis: {
                                        categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dez'],
                                      },
                                      yaxis: {
                                        title: {
                                          text: ' (feitos)'
                                        }
                                      },
                                      fill: {
                                        opacity: 1
                                      },
                                      tooltip: {
                                        y: {
                                          formatter: function(val) {
                                            return " " + val + " feitas"
                                          }
                                        }
                                      }
                                    }).render();
                                  });
                                </script>
                                <!-- End Column Chart -->
                  
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

                    @if ($utilizadorLogado->tipo_acesso != 3)
                    @livewire('pagina-inicial.grafico-geral')
                    @endif
                </div>
            </div>
        </section>
    </main>
</div>
