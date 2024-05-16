<div class="card">
    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <div class="col" style="display: inline-block; width: 120px; height: 120px;">
            @if ($foto)
                <a href="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                    style="display: inline-block; width: inherit; height: inherit">
                    <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}" class="rounded-circle" alt="foto"
                        style="width: inherit; height: inherit; object-fit: cover;">
                </a>
            @else
                <a href="#" style="display: inline-block; width: inherit; height: inherit">
                    <img src="{{ asset('assets/img/img_default.jpg') }}" alt="foto"
                        style="width: inherit; height: inherit; object-fit: cover;">
                </a>
            @endif
        </div>
        <h3 class="pt-2"><b>{{ $utilizador->name }}</b></h3>
        <h3>{{ ucwords($utilizador->buscarTipoAcesso->tipo) }}</h3>
        <div class="social-links mt-2">
            <a href="{{ $dadosPessoais->twitter != null ? $dadosPessoais->twitter : '#' }}" class="twitter"><i
                    class="bi bi-twitter"></i></a>
            <a href="{{ $dadosPessoais->facebook != null ? $dadosPessoais->facebook : '#' }}" class="facebook"><i
                    class="bi bi-facebook"></i></a>
            <a href="{{ $dadosPessoais->instagram != null ? $dadosPessoais->instagram : '#' }}" class="instagram"><i
                    class="bi bi-instagram"></i></a>
            <a href="{{ $dadosPessoais->linkedin != null ? $dadosPessoais->linkedin : '#' }}" class="linkedin"><i
                    class="bi bi-linkedin"></i></a>
                    
            @php
                $idLogado = \Illuminate\Support\Facades\Auth::user()->id;
            @endphp
            @if ($idLogado != $utilizador->id)
                <a href="{{ route('chat.conversa', [$idLogado, $utilizador->id]) }}" class="chat-dots-fill"><i
                        class="bi bi-chat-dots-fill"></i></a>
            @endif
        </div>
    </div>
</div>
