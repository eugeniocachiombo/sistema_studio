@include('inclusao.headHtml')
<title>Listagem de estilos</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('estilos.listar')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')