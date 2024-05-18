@include('inclusao.headHtml')
<title>Actualizar grupo</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('grupos.actualizar', ["id" => $id])
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')