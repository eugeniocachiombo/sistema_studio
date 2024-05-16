<div class="tab-pane fade pt-3 {{ $tabConteudoEditarPasse }}" id="profile-change-password">
    <form wire:submit.prevent="alterarPalavraPasse">
        <div class="row mb-3">
            <label for="passeActual" class="col-md-4 col-lg-3 col-form-label">Passe
                Actual</label>
            <div class="col-md-8 col-lg-9">
                <input type="password" class="form-control" wire:model="passeActual" id="passeActual">
                <div class="text-danger pt-2" style="font-size: 12.5px">
                    @error('passeActual')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="passeNova" class="col-md-4 col-lg-3 col-form-label">Nova
                Passe</label>
            <div class="col-md-8 col-lg-9">
                <input type="password" class="form-control" wire:model="passeNova" id="passeNova">
                <div class="text-danger pt-2" style="font-size: 12.5px">
                    @error('passeNova')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="passeConfirmacao" class="col-md-4 col-lg-3 col-form-label">Confirmar Nova Passe</label>
            <div class="col-md-8 col-lg-9">
                <input type="password" class="form-control" wire:model="passeConfirmacao" id="passeConfirmacao">
                <div class="text-danger pt-2" style="font-size: 12.5px">
                    @error('passeConfirmacao')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Alterar
                Palavra-passe</button>
        </div>
    </form>
</div>
