@include('inclusao.headHtml')
<title>Listagem de agendamentos de mixagem</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('mixagem.listar')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')