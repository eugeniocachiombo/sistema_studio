@include('inclusao.headHtml')
<title>Actualizar Acesso</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('utilizador.actualizar-acesso', ["id" => $id])
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')