@include('inclusao.headHtml')
<title>Chat</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    @livewire('chat.conversa', ["utilizador" => $utilizador, "remente" => $remente])
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')
 