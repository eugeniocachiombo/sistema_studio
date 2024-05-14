

@livewireScripts
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{ asset('assets/js/main.js')}}"></script>

<!--Data Table em portugês -->
<link rel="stylesheet" type="text/css" href="{{asset("assets/datatablePT/dataTable.css")}}">
<script src="{{asset("assets/datatablePT/dataTable.js")}}"></script>

<script>
    $(document).ready(function() {
        $('.datatablePT').DataTable({
            "language": {
                "sEmptyTable":     "Nenhum registro encontrado",
                "sInfo":           "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered":   "(Filtrados de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ".",
                "sLengthMenu":     "_MENU_ Resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing":     "Processando...",
                "sZeroRecords":    "Nenhum registro encontrado",
                "sSearch":         "Pesquisar",
                "oPaginate": {
                    "sNext":     "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst":    "Primeiro",
                    "sLast":     "Último"
                },
                "oAria": {
                    "sSortAscending":  ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "order": [[0, 'desc']]
        });
    });
</script>
</body>
</html>