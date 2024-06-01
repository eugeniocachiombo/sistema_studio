<form wire:submit.prevent="enviarMensagem" class="php-email-form needs-validation mt-4" novalidate>
    <div class="col-md-12">
        @if ($ocultarValidate == false)
            @error('mensagem')
                <div class="alert alert-danger ">
                    <span class="error">{{ $message }}</span>
                </div>
            @enderror
        @endif
        <textarea class="form-control" rows="{{ $rowsMessagem ? $rowsMessagem : 5 }}" wire:model="mensagem"
            placeholder="{{ $placeholderMsg ? $placeholderMsg : 'Escreva sua mensagem aqui' }}" required></textarea>
    </div>

    <div class="col-md-12 text-center d-flex pt-4">
        <div class="col">
            <a class="btn btn-primary btn-md" wire:click='habilitarInputFile'>
                <i class="bi bi-upload "></i> Carregar arquivo
            </a>
        </div>

        <div class="col">
            <span class="text-primary" style="font-size: 20px" wire:loading wire:target='enviarMensagem'>
                <span class="spinner-border spinner-border-sm"></span>
                Processando...
            </span>
            <button class="btn btn-primary btn-lg" type="submit" wire:loading.attr='disabled' wire:loading.remove
                wire:target='enviarMensagem'>
                <i class="bi bi-cursor-fill text-light"></i> Enviar
            </button>
        </div>
    </div>
</form>
