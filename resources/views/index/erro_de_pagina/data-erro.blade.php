<title>Página / Não encontrada 404 </title>
@include('inclusao.headHtml')
<main>
    <div class="container">
        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>Erro</h1>
            <h2>Impossível aceder o sistema, verifique a data.</h2>
            <h2>O Sistena só pode ser acessado em Angola</h2>
            <h2>{{session("estado")}}</h2>
            <a class="btn" href="{{ route('pagina_inicial.') }}">Ir para Início</a>
            <img src="{{ asset('assets/img/not-found.svg') }}" class="img-fluid py-5" alt="Page Not Found">
            <div class="credits">
            </div>
        </section>
    </div>
</main>
@include('inclusao.footHtml')
