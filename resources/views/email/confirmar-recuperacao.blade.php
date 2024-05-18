@include('inclusao.headHtml')
<main>
    <center>
        <a href="{{ route('pagina_inicial.') }}" style="text-decoration: none">
            <img src="{{ asset('assets/img/logo.png') }}" alt="">
            <h1 style="color: black">@include('inclusao.nomesite')</h1>
        </a>
    </center>
    <hr>
    <h3>{{ $msg }}</h3>
    <h1>{{ $digitos[0] }} {{ $digitos[1] }} {{$digitos[2]}} {{ $digitos[3] }}</h1>
    <hr>
    @include('inclusao.footer')
</main>
