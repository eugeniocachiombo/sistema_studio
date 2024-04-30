@include('inclusao.headHtml')
<title>Agendamento de gravação</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('gravacao.agendar')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')