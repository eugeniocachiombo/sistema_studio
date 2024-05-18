@include('inclusao.headHtml')
<title>Criação de estilos</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('estilos.adicionar')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')