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
                text: ' (Gráfico de servicos)'
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
    </div>
  </div>
