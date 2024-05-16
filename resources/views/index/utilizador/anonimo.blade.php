@include('inclusao.headHtml')
<title>Perfil do utilizador</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('utilizador.anonimo', ["id" => $id])
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')