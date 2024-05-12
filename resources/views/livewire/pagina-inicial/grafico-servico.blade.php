<div class="card card-animated">
    <div class="card-body">
      <h5 class="card-title">Gráfico de Serviços Feitos</h5>
      
      <div id="columnChart"></div>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          new ApexCharts(document.querySelector("#columnChart"), {
            series: [{
              name: 'Gravação',
              data: [
                "<?php echo $this->dadosJaneiro(1)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(2)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(3)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(4)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(5)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(6)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(7)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(8)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(9)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(10)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(11)['gravacao'] ?>", 
                "<?php echo $this->dadosJaneiro(12)['gravacao'] ?>"
              ]
          }, {
              name: 'Mixagem',
              data: [
                "<?php echo $this->dadosJaneiro(1)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(2)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(3)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(4)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(5)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(6)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(7)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(8)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(9)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(10)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(11)['mixagem'] ?>", 
                "<?php echo $this->dadosJaneiro(12)['mixagem'] ?>"
              ]
            }, {
              name: 'Masterização',
              data: [
                "<?php echo $this->dadosJaneiro(1)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(2)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(3)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(4)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(5)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(6)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(7)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(8)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(9)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(10)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(11)['masterizacao'] ?>", 
                "<?php echo $this->dadosJaneiro(12)['masterizacao'] ?>"
              ]
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
  <script src="{{ asset('assets/js/temporeal_grafico_servicos.js') }}"></script>