<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        overflow-x: hidden;
        position: absolute; /* Posicione absolutamente para funcionar com z-index */
        z-index: 9999; /* Defina um valor alto para o z-index */
    }
    
    * html .ui-autocomplete {
        height: 100px;
    }
</style>

<script>
    $(function() {
        var availableTags = [
            { label: "ActionScript", value: "actionscript", route: "{{ route('pagina_inicial.') }}" },
            { label: "AppleScript", value: "applescript", route: "{{ route('pagina_inicial.') }}" },
            { label: "Asp", value: "asp", route: "{{ route('pagina_inicial.') }}" },
            { label: "Página Inicial", value: "asp", route: "{{ route('pagina_inicial.') }}" },
        ];

        $("#campoPesquisa").autocomplete({
            source: availableTags,
            select: function(event, ui) {
                window.location.href = ui.item.route;
            }
        });
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
