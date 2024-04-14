@if ($this->habilitarUpload == true)
    <div class="col bg-primary align-items-center d-flex justify-content-between border">
        <div class="col">
            <label for="file-input" class="file-input {{ $arquivo ? 'bg-success' : '' }} ">
                @if ($arquivo)
                    @switch($this->buscarTipoArquivo($extensaoArquivo))
                        @case('img')
                            <i class="bi bi-file-earmark-image" style="font-size: 20px;"></i>
                        @break

                        @case('audio')
                            <i class="bi bi-file-earmark-music" style="font-size: 20px"></i>
                        @break

                        @case('texto')
                            @if ($extensaoArquivo == 'pdf')
                                <i class="bi bi-file-earmark-pdf" style="font-size: 20px"></i>
                            @elseif($extensaoArquivo == 'txt')
                                <i class="bi bi-file-earmark-font" style="font-size: 20px"></i>
                            @endif
                        @break

                        @default
                            <i class="bi bi-exclamation-triangle" style="font-size: 20px"></i>
                        @break
                    @endswitch

                    <span class="text-light"> <b>{{ $this->nomeArquivo }}</b> </span>
                @else
                    Escolha um arquivo
                @endif
                <input type="file" wire:model="arquivo" name="file" id="file-input">
            </label>
        </div>

        <div class="col  d-flex  align-items-center">
            <span class="text-light" id="nomeArquivo">
                @if ($arquivo)
                    <b>Arquivo Carregado</b>
                @else
                    Nenhum arquivo escolhido
                @endif
            </span>
        </div>
    </div>

    @empty($arquivo)
        <div class="container d-table bg-primary text-light  align-items-center">
            <div class="row">
                <div class="col">
                    <b>Somente Com Extensões:</b>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    @foreach ($this->extensoesAceites as $chave => $extensao)
                        @for ($i = 0; $i < count($extensao); $i++)
                            {{ $extensao[$i] . ' -' }}
                        @endfor
                    @endforeach
                </div>
            </div>
        </div>
    @endempty
@endif
