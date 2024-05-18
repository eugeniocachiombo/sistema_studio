@include('inclusao.headHtml')
<title>Todos Utilizadores</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('utilizador.lista-todos')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')