@section('titulo', 'Chat')
<div>
    <link rel="stylesheet" href="{{ asset('assets/css/paginacao-conversa.css') }}">
    <div>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Conversa</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Chat</a></li>
                        <li class="breadcrumb-item active">Conversa</li>
                    </ol>
                </nav>
            </div>

            <section class="section">
                <div class="row gy-4">
                    <div class="col">
                        <div class="card card-animated p-4">
                            @include('livewire.chat.inc.desc-remente')
                            <hr>
                            @include('livewire.chat.inc.mensagens')
                            @include('livewire.chat.inc.form-envio')
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="{{ asset('assets/js/textoEmVoz.js') }}"></script>
    <script src="{{ asset('assets/js/temporeal_conversa.js') }}"></script>
</div>
