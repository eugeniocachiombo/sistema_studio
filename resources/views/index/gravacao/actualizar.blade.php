@include('inclusao.headHtml')
<title>Actualizar agendamento de gravação</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('gravacao.actualizar', ["idGravacao" => $idGravacao])
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')