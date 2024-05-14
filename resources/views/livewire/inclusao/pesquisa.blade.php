<link rel="stylesheet" href="{{asset("assets/autocompleteOffline/jquery-ui.css")}}">
<script src="{{asset("assets/autocompleteOffline/jquery-3.6.0.js")}}"></script>
<script src="{{asset("assets/autocompleteOffline/jquery-ui.js")}}"></script>
<link rel="stylesheet" href="{{asset("assets/autocompleteOffline/estilo.css")}}">
<script>
    $(function() {
        if($("#campoPesquisaLogado").val() != undefined){
            pesquisarLogado();
        }else{
            pesquisarSemLogar();
        }

        function pesquisarLogado(){
            var rotasDisponiveis = [
                {
                    label: "Página Inicial",
                    value: "Página Inicial",
                    route: "{{ route('pagina_inicial.') }}",
                    description: "- Inicio"
                }, 
                {
                    label: "Centrar de ajuda",
                    value: "Ajuda",
                    route: "{{ route('info.ajuda') }}",
                    description: "- Página de suporte ao utilizador"
                },
                {
                    label: "Contacte-nos",
                    value: "Contacte-nos",
                    route: "{{ route('info.contacto') }}",
                    description: "- Comunicar um problema, dar sugestões ou deixar uma mensagem"
                },
                {
                    label: "Perfil do utilizador",
                    value: "Perfil",
                    route: "{{ route('utilizador.perfil') }}",
                    description: "- Informações do perfil e configurações"
                },
                {
                    label: "Agendamento de Gravação",
                    value: "Gravação",
                    route: "{{ route('gravacao.agendar') }}",
                    description: "- Página de agendamento de gravações"
                },
                {
                    label: "Listagem de Gravação",
                    value: "Gravação",
                    route: "{{ route('gravacao.listar') }}",
                    description: "- Página de listagem de gravações"
                },
                {
                    label: "Concluir Gravação",
                    value: "Gravação",
                    route: "{{ route('gravacao.concluir') }}",
                    description: "- Página de conclusão de gravações"
                },
                {
                    label: "Agendamento de Mixagem",
                    value: "Mixagem",
                    route: "{{ route('mixagem.agendar') }}",
                    description: "- Página de agendamento de mixagens"
                },
                {
                    label: "Listagem de Mixagem",
                    value: "Mixagem",
                    route: "{{ route('mixagem.listar') }}",
                    description: "- Página de listagem de mixagens"
                },
                {
                    label: "Concluir Mixagem",
                    value: "Mixagem",
                    route: "{{ route('mixagem.concluir') }}",
                    description: "- Página de conclusão de mixagens"
                },
                {
                    label: "Agendamento de Masterização",
                    value: "Masterização",
                    route: "{{ route('masterizacao.agendar') }}",
                    description: "- Página de agendamento de masterizações"
                },
                {
                    label: "Listagem de Masterização",
                    value: "Masterização",
                    route: "{{ route('masterizacao.listar') }}",
                    description: "- Página de listagem de masterizações"
                },
                {
                    label: "Concluir Masterização",
                    value: "Masterização",
                    route: "{{ route('masterizacao.concluir') }}",
                    description: "- Página de conclusão de masterizações"
                },
            ];

            $("#campoPesquisaLogado").autocomplete({
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
        }

        function pesquisarSemLogar(){
            var rotasDisponiveis = [
                {
                    label: "Centrar de ajuda",
                    value: "Ajuda",
                    route: "{{ route('info.ajuda') }}",
                    description: "- Página de suporte ao utilizador"
                },
                {
                    label: "Contacte-nos",
                    value: "Contacte-nos",
                    route: "{{ route('info.contacto') }}",
                    description: "- Comunicar um problema, dar sugestões ou deixar uma mensagem"
                },
                {
                    label: "Cadastrar-se",
                    value: "Cadastrar-se",
                    route: "{{ route('utilizador.cadastro') }}",
                    description: "- Criar uma conta"
                },
                {
                    label: "Autenticar-se",
                    value: "Cadastrar-se",
                    route: "{{ route('utilizador.autenticacao') }}",
                    description: "- Iniciar Sessão"
                },
            ];

            $("#campoPesquisaNaoLogado").autocomplete({
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
        }
    });
</script>

@if (session('utilizador'))
    <div class="search-bar">
        <div class="ui-widget">
            <form class="search-form d-flex align-items-center" wire:submit.prevent="submitForm">
                <input type="text" id="campoPesquisaLogado" wire:model="valorPesquisa" autocomplete="off" placeholder="Pesquisar">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
@else
    <div class="search-bar">
        <div class="ui-widget">
            <form class="search-form d-flex align-items-center" wire:submit.prevent="submitForm">
                <input type="text" id="campoPesquisaNaoLogado" wire:model="valorPesquisa" autocomplete="off" placeholder="Pesquisar">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
@endif



