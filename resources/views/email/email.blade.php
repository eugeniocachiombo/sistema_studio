<main>
    @include('inclusao.logo&nome')
    <h1>{{ $assunto }}</h1><br>
    <h4>{{ $msg }}</h4>
    <hr>
    <b>Responsável</b> <br>
    Nome: {{ $nome }} <br>
    Email: <a href="{{ route('utilizador.autenticacao') }}">{{ $email }}</a>
    <hr>
    @include('inclusao.footer')
</main>
