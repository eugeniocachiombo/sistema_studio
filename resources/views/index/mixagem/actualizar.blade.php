@include('inclusao.headHtml')
<title>Actualizar agendamento de mixagem</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('mixagem.actualizar', ["idMixagem" => $idMixagem])
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')