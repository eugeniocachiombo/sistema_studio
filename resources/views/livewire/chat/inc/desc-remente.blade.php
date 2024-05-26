<caption>
    <h4> 
        <b class="text-primary">
            <a href="{{ route('utilizador.anonimo', $remente) }}">
                @php
                    $foto = $this->buscarFotoPerfil($remente);
                @endphp
                @if ($foto)
                    <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                        class="rounded-circle me-2" alt="foto"
                        style="width: 40px; height: 40px; object-fit: cover;">
                @else
                    <img src="{{ asset('assets/img/img_default.jpg') }}" class="me-2"
                        alt="foto"
                        style="width: 40px; height: 40px; object-fit: cover;">
                @endif

                {{ $this->buscarNomeUsuario($remente) }}
            </a>
        </b>
    </h4>
</caption>