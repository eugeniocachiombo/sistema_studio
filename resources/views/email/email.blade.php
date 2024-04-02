@include('inclusao.headHtml')
<main>
    @include('inclusao.logo&nome')
    <h2>{{ $assunto }}</h2>
    <h3>{{ $msg }}</h3>
    <hr>
    <center>
        <img src="{{ asset('assets/img/logo.png') }}" alt="">
        <h1>@include('inclusao.nomesite')</h1>
    </center>
    <hr>
    <b>Responsável</b> <br>
    Nome: {{ $nome }} <br>
    Email: <a href="{{ route('utilizador.autenticacao') }}">{{ $email }}</a>
    <hr>
    @include('inclusao.footer')
</main>
