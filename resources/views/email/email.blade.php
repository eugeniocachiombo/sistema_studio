@include('inclusao.headHtml')
<main>
    <center>
        <a href="{{ route('pagina_inicial.') }}" style="text-decoration: none">
            <img src="{{ asset('assets/img/logo.png') }}" alt="">
            <h1 style="color: black">@include('inclusao.nomesite')</h1>
        </a>
    </center> <hr>
    <h2>{{ $assunto }}</h2>
    <h3>{{ $msg }}</h3>
    <hr>
    <b>Responsável</b> <br>
    Nome: {{ $nome }} <br>
    Email: <a href="{{ route('utilizador.autenticacao') }}">{{ $email }}</a>
    <hr>
    @include('inclusao.footer')
</main>

