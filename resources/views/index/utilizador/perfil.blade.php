@include('inclusao.headHtml')
<title>Perfil do utilizador</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('utilizador.perfil')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')