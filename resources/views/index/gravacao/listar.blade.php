@include('inclusao.headHtml')
<title>Listagem de agendamentos de gravação</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('gravacao.listar')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')