<div class="card card-animated">
    <div class="filter d-none">
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

    <div class="card-body pb-0">
        <h5 class="card-title">Gráfico Geral</h5>

        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        top: '5%',
                        left: 'center'
                    },
                    series: [{
                        name: 'Total de ',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '18',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [{
                                value: '<?php echo count($totalClientes) ?>',
                                name: 'Clientes'
                            },
                            {
                                value: 735,
                                name: 'Gravação'
                            },
                            {
                                value: 580,
                                name: 'Mixagem'
                            },
                            {
                                value: 484,
                                name: 'Masterização'
                            },
                            {
                                value: '<?php echo count($totalFuncionarios) ?>',
                                name: 'Funcionários'
                            }
                        ]
                    }]
                });
            });
        </script>

    </div>
</div>