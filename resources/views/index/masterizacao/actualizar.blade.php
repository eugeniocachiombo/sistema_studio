@include('inclusao.headHtml')
<title>Actualizar agendamento de masterização</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('masterizacao.actualizar', ["idMasterizacao" => $idMasterizacao])
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')