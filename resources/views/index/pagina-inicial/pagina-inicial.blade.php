@include('inclusao.headHtml')
<title>Página Inicial</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('pagina-inicial.pagina-inicial')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')