<a id="bgMsg" class="border border-primary bg-white pt-1 d-flex justify-content-center align-items-center"
    href="{{ route('chat.conversa', [$utilizador_id, $idRemente]) }}" style="border-radius: 50px">

    <div class="col text-center mt-2 me-1 ms-1">
        @php
            $foto = $this->buscarFotoPerfil($idRemente);
        @endphp
        @if ($foto)
            <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}" class="rounded-circle" alt="foto"
                style="width: 70px; height: 70px; object-fit: cover;">
        @else
            <img src="{{ asset('assets/img/img_default.jpg') }}" class="me-2" alt="foto"
                style="border-radius: 13px; width: 60px; height: 60px; object-fit: cover;">
        @endif
    </div>

    <div class="col-7 ">
        <b class="text-dark">{{ $nome }}</b>
        <p class="text-dark mt-3">
            @if ($conversa->caminho_arquivo != '' && $conversa->tipo_arquivo != '')
                @switch($conversa->tipo_arquivo)
                    @case('img')
                        <b>Arquivo de Foto</b>
                    @break

                    @case('audio')
                        <b>Arquivo de Áudio</b>
                    @break

                    @case('texto')
                        <b>Arquivo de Texto</b>
                    @break

                    @default
                @endswitch
            @else
                @if (strlen(Crypt::decrypt($conversa->mensagem)) < 15)
                    {{ Crypt::decrypt($conversa->mensagem) }}
                @else
                    {{ substr(Crypt::decrypt($conversa->mensagem), 0, 15) }}...
                @endif
            @endif
        </p>

        <p class="text-dark">{{ $this->formatarData($conversa->created_at) }}
        </p>
    </div>

    <div class="col text-center">
        @if ($conversa->estado == 'lido')
            <i class="bi bi-check-circle-fill text-primary"></i>
        @else
            <i class="bi bi-check text-primary"></i>
        @endif
    </div>
</a>
