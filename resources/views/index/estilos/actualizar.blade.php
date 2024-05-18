@include('inclusao.headHtml')
<title>Actualizar estilo</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('estilos.actualizar', ["id" => $id])
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')