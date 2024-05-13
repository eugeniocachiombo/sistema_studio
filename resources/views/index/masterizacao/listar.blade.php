@include('inclusao.headHtml')
<title>Listagem de agendamentos de masterização</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('masterizacao.listar')
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')