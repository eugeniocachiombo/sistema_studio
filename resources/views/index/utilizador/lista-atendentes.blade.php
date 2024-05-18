@include('inclusao.headHtml')
<title>Todos Atendentes</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('utilizador.lista-atendentes')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')