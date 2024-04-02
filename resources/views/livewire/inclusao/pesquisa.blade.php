<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        overflow-x: hidden;
        position: absolute;
        z-index: 9999;
    }

    * html .ui-autocomplete {
        height: 100px;
    }

    .description {
        font-size: 0.8em;
        color: rgb(0, 0, 0); /* Cor do texto da descrição */
        background-color: transparent; /* Fundo transparente para não alterar a cor de fundo do item */
        margin-top: 5px;
    }

    .ui-autocomplete li.ui-state-hover {
        background-color: transparent !important; /* Evitar mudança de cor de fundo ao passar o mouse */
    }
</style>

<script>
    $(function() {
        var availableTags = [
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
            source: availableTags,
            select: function(event, ui) {
                window.location.href = ui.item.route;
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div class='description'>" + item.label + " <span style='font-size:1.0em; color: #999'>" + item
                    .description + "</span></div>")
                .appendTo(ul);
        };;
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
