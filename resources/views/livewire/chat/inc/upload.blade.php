@if ($this->habilitarUpload == true)
    <div class="col bg-primary aling-items-center d-flex justify-content-between mt-4 border">
        <div class="col">
            <label for="file-input" class="file-input">
                Escolha um arquivo
                <input type="file" wire:model="arquivo" name="file" id="file-input">
            </label>
        </div>

        <div class="col  d-flex  align-items-center">
            <span class="text-light"
                id="nomeArquivo">{{ $arquivo ? $this->nomeArquivo : 'Nenhum arquivo escolhido' }}</span>
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
