@include('inclusao.headHtml')
<title>Listagem de grupos</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('grupos.listar')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')