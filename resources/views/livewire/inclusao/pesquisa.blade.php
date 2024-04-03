<link rel="stylesheet" href="{{asset("assets/autocompleteOffline/jquery-ui.css")}}">
<script src="{{asset("assets/autocompleteOffline/jquery-3.6.0.js")}}"></script>
<script src="{{asset("assets/autocompleteOffline/jquery-ui.js")}}"></script>
<link rel="stylesheet" href="{{asset("assets/autocompleteOffline/estilo.css")}}">
<script>
    $(function() {
        var rotasDisponiveis = [
            {
                label: "Página Inicial",
                value: "Página Inicial",
                route: "{{ route('pagina_inicial.') }}",
                description: "Incio de toda página"
            }, 
            {
                label: "Página Inicial",
                value: "Página Inicial",
                route: "{{ route('pagina_inicial.') }}",
                description: "Linguagem de programação para scripts em páginas da web"
            },
        ];

        $("#campoPesquisa").autocomplete({
            source: rotasDisponiveis,
            select: function(event, ui) {
                window.location.href = ui.item.route;
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div class='description'>" + item.label + " <span style='font-size:1.0em; color: #999'>" + item
                    .description + "</span></div>")
                .appendTo(ul);
        };
    });
</script>
<div class="search-bar">
    <div class="ui-widget">
        <form class="search-form d-flex align-items-center" wire:submit.prevent="submitForm">
            <input type="text" id="campoPesquisa" wire:model="valorPesquisa" autocomplete="off" placeholder="Pesquisar">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>
</div>


