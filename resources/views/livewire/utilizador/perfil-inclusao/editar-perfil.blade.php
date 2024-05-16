<div class="tab-pane fade {{ $tabConteudoEditarPerfil }} profile-edit pt-3" id="profile-edit">
    <form class="needs-validation">
        <div class="row mb-3">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Imagem do
                perfil
            </label>
            <div class="col-md-8 col-lg-9">
                <div class="col" style="display: inline-block; width: 120px; height: 120px;">
                    @if ($foto)
                        <a href="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                            style="display: inline-block; width: inherit; height: inherit">
                            <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}" alt="foto"
                                style="width: inherit; height: inherit; object-fit: cover;">
                        </a>
                    @else
                        <a href="#" style="display: inline-block; width: inherit; height: inherit">
                            <img src="{{ asset('assets/img/img_default.jpg') }}" alt="foto"
                                style="width: inherit; height: inherit; object-fit: cover;">
                        </a>
                    @endif
                </div>


                <div class="pt-2">
                    <label for="file-input" class="btn btn-primary btn-sm text-light" title="Actualizar foto de perfil">
                        <i class="bi bi-upload"></i>
                        {{ $nomeArquivo ? $nomeArquivo : '' }}
                        <input type="file" wire:model="arquivo" name="file" id="file-input" style="display: none;"
                            required>
                    </label>

                    <a href="#" wire:click="clickBtnEliminarFoto({{ $utilizador_id }})"
                        class="btn btn-danger btn-sm" title="Remover a imagem do perfil"><i class="bi bi-trash"></i></a>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="nome" class="col-md-4 col-lg-3 col-form-label">
                Nome</label>
            <div class="col-md-8 col-lg-9">
                <input name="nome" type="text" class="form-control" id="nome" wire:model="nome">
                <div class="text-danger pt-2" style="font-size: 12.5px">
                    @error('nome')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="sobrenome" class="col-md-4 col-lg-3 col-form-label">
                Sobrenome</label>
            <div class="col-md-8 col-lg-9">
                <input name="sobrenome" type="text" class="form-control" id="sobrenome" wire:model="sobrenome">
                <div class="text-danger pt-2" style="font-size: 12.5px">
                    @error('sobrenome')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="sobre" class="col-md-4 col-lg-3 col-form-label">Sobre</label>
            <div class="col-md-8 col-lg-9">
                <textarea wire:model="sobre" name="sobre" class="form-control" id="sobre" style="height: 100px"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="nomeArtistico" class="col-md-4 col-lg-3 col-form-label">Nome
                Artístico</label>
            <div class="col-md-8 col-lg-9">
                <input name="nomeArtistico" type="text" class="form-control" id="nomeArtistico"
                    wire:model="nomeArtistico">
                <div class="text-danger pt-2" style="font-size: 12.5px">
                    @error('nomeArtistico')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="genero" class="col-md-4 col-lg-3 col-form-label">Gênero</label>
            <div class="col-md-8 col-lg-9">
                <select wire:model="genero" name="genero" type="text" class="form-control" id="genero">
                    <option value="M" selected>Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="nascimento" class="col-md-4 col-lg-3 col-form-label">Nascimento</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="nascimento" name="nascimento" type="date" class="form-control" id="nascimento">
                <div class="text-danger pt-2" style="font-size: 12.5px">
                    @error('nascimento')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="telefone" class="col-md-4 col-lg-3 col-form-label">Telefone</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="telefone" name="telefone" type="text" class="form-control" id="telefone">
                <div class="text-danger pt-2" style="font-size: 12.5px">
                    @error('telefone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="email" name="email" type="email" class="form-control" id="email">
                <div class="text-danger pt-2" style="font-size: 12.5px">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="nacionalidade" class="col-md-4 col-lg-3 col-form-label">Nacionalidade</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="nacionalidade" name="nacionalidade" type="text" class="form-control"
                    id="nacionalidade">
            </div>
        </div>

        <div class="row mb-3">
            <label for="provincia" class="col-md-4 col-lg-3 col-form-label">Província</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="provincia" name="provincia" type="text" class="form-control" id="provincia">
            </div>
        </div>

        <div class="row mb-3">
            <label for="municipio" class="col-md-4 col-lg-3 col-form-label">Município</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="municipio" name="municipio" type="text" class="form-control" id="municipio">
            </div>
        </div>

        <div class="row mb-3">
            <label for="endereco" class="col-md-4 col-lg-3 col-form-label">Endereço</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="endereco" name="endereco" type="text" class="form-control" id="endereco">
            </div>
        </div>

        <div class="row mb-3">
            <label for="twitter" class="col-md-4 col-lg-3 col-form-label">Twitter</label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="twitter" name="twitter" type="text" class="form-control" id="twitter">
            </div>
        </div>

        <div class="row mb-3">
            <label for="facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
            </label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="facebook" name="facebook" type="text" class="form-control" id="facebook">
            </div>
        </div>

        <div class="row mb-3">
            <label for="instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
            </label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="instagram" name="instagram" type="text" class="form-control" id="instagram">
            </div>
        </div>

        <div class="row mb-3">
            <label for="linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
            </label>
            <div class="col-md-8 col-lg-9">
                <input wire:model="linkedin" name="linkedin" type="text" class="form-control" id="linkedin">
            </div>
        </div>

        <div class="text-center">
            <button wire:click="actualizarDadosPerfil" type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>
