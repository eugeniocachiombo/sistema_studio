<div>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Perfil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Utilizador</li>
                    <li class="breadcrumb-item active">Perfil & Configurações</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    @php
                        $dadosUtilizador = $this->buscarDadosUtilizador($utilizador_id);
                        $foto = $this->buscarFotoPerfil($utilizador_id);
                    @endphp

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <div class="col" style="display: inline-block; width: 120px; height: 120px;">
                                @if ($foto)
                                    <a href="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                        style="display: inline-block; width: inherit; height: inherit">
                                        <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                            class="rounded-circle" alt="foto"
                                            style="width: inherit; height: inherit; object-fit: cover;">
                                    </a>
                                @else
                                    <a href="#" style="display: inline-block; width: inherit; height: inherit">
                                        <img src="{{ asset('assets/img/img_default.jpg') }}" alt="foto"
                                            style="width: inherit; height: inherit; object-fit: cover;">
                                    </a>
                                @endif
                            </div>
                            <h2>{{ session('utilizador') }}</h2>
                            <h3>{{ ucwords($dadosUtilizador->buscarTipoAcesso->tipo) }}</h3>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">

                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link {{$tabVisaoGeral}}" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Visão Geral</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link {{$tabEditarPerfil}}" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar
                                        Perfil</button>
                                </li>
                                
                                <li class="nav-item">
                                    <button class="nav-link {{$tabEditarPasse}}" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Alterar Palavra-passe</button>
                                </li>

                            </ul>

                            @php
                                $utilizador = $this->buscarDadosUtilizador($utilizador_id);
                                $dadosPessoal = $this->buscarDadosPessoal($utilizador->id);
                                $acesso = $this->buscarTipoAcesso($utilizador->tipo_acesso);
                                $nascimento = $this->buscarNascimento($dadosPessoal->nascimento);
                            @endphp

                            <div class="tab-content pt-2">
                                {{-- Visão Geral --}}
                                <div class="tab-pane fade {{$tabConteudoVisaoGeral}} profile-overview" id="profile-overview">
                                    <h5 class="card-title">Sobre</h5>
                                    <p class="small fst-italic">
                                        {{ $dadosPessoal->sobre != null ? $dadosPessoal->sobre : 'Sem informação' }}</p>

                                    <h5 class="card-title">Detalhes do Perfil</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nome Completo</div>
                                        <div class="col-lg-9 col-md-8">{{ ucwords($dadosPessoal->nome) }}
                                            {{ ucwords($dadosPessoal->sobrenome) }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nome Artístico</div>
                                        <div class="col-lg-9 col-md-8">{{ ucwords($utilizador->name) }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Gênero</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $dadosPessoal->genero == 'M' ? 'Masculino' : 'Femenino' }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nascimento</div>
                                        <div class="col-lg-9 col-md-8">{{ $nascimento }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Telefone</div>
                                        <div class="col-lg-9 col-md-8">(+244) {{ $utilizador->telefone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $utilizador->email }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Acesso</div>
                                        <div class="col-lg-9 col-md-8">{{ ucwords($acesso->tipo) }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nacionalidade</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $dadosPessoal->nacionalidade != null ? ucwords($dadosPessoal->nacionalidade) : 'Sem informação' }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Endereço</div>
                                        @php
                                            $provincia =
                                                $dadosPessoal->provincia != null
                                                    ? ucwords($dadosPessoal->provincia)
                                                    : 'Sem informação';
                                            $municipio =
                                                $dadosPessoal->municipio != null
                                                    ? ucwords($dadosPessoal->municipio)
                                                    : 'Sem informação';
                                            $endereco =
                                                $dadosPessoal->endereco != null
                                                    ? ucwords($dadosPessoal->endereco)
                                                    : 'Sem informação';
                                        @endphp
                                        <div class="col-lg-9 col-md-8">{{ $provincia }}, {{ $municipio }},
                                            {{ $endereco }}</div>
                                    </div>
                                </div>

                                {{-- Editar Perfil --}}
                                <div class="tab-pane fade {{$tabConteudoEditarPerfil}} profile-edit pt-3" id="profile-edit">
                                    <form class="needs-validation" >
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Imagem do
                                                perfil
                                            </label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="col"
                                                    style="display: inline-block; width: 120px; height: 120px;">
                                                    @if ($foto)
                                                        <a href="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                                            style="display: inline-block; width: inherit; height: inherit">
                                                            <img src="{{ asset('assets/' . $foto->caminho_arquivo) }}"
                                                                alt="foto"
                                                                style="width: inherit; height: inherit; object-fit: cover;">
                                                        </a>
                                                    @else
                                                        <a href="#"
                                                            style="display: inline-block; width: inherit; height: inherit">
                                                            <img src="{{ asset('assets/img/img_default.jpg') }}"
                                                                alt="foto"
                                                                style="width: inherit; height: inherit; object-fit: cover;">
                                                        </a>
                                                    @endif
                                                </div>


                                                <div class="pt-2">
                                                    <label for="file-input" class="btn btn-primary btn-sm text-light"
                                                        title="Actualizar foto de perfil">
                                                        <i class="bi bi-upload"></i>
                                                        {{ $nomeArquivo ? $nomeArquivo : '' }}
                                                        <input type="file" wire:model="arquivo" name="file"
                                                            id="file-input" style="display: none;" required>
                                                    </label>

                                                    <a href="#"
                                                        wire:click="clickBtnEliminarFoto({{ $utilizador_id }})"
                                                        class="btn btn-danger btn-sm"
                                                        title="Remover a imagem do perfil"><i
                                                            class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nome" class="col-md-4 col-lg-3 col-form-label">
                                                Nome</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nome" type="text" class="form-control"
                                                    id="nome" wire:model="nome">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="sobrenome" class="col-md-4 col-lg-3 col-form-label">
                                                Sobrenome</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="sobrenome" type="text" class="form-control"
                                                    id="sobrenome" wire:model="sobrenome"  >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="sobre"
                                                class="col-md-4 col-lg-3 col-form-label">Sobre</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea wire:model="sobre" name="sobre" class="form-control" id="sobre" style="height: 100px"></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nomeArtistico" class="col-md-4 col-lg-3 col-form-label">Nome
                                                Artístico</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nomeArtistico" type="text" class="form-control"
                                                    id="nomeArtistico" wire:model="nomeArtistico" >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="genero"
                                                class="col-md-4 col-lg-3 col-form-label">Gênero</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select wire:model="genero" name="genero" type="text" class="form-control"
                                                    id="genero">
                                                        <option value="M" selected>Masculino</option>
                                                        <option value="F">Femenino</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nascimento"
                                                class="col-md-4 col-lg-3 col-form-label">Nascimento</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="nascimento" name="nascimento" type="date" class="form-control"
                                                    id="nascimento"  >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="telefone"
                                                class="col-md-4 col-lg-3 col-form-label">Telefone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="telefone" name="telefone" type="text" class="form-control"
                                                    id="telefone" >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email"
                                                class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="email" name="email" type="email" class="form-control"
                                                    id="email" >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nacionalidade"
                                                class="col-md-4 col-lg-3 col-form-label">Nacionalidade</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="nacionalidade" name="nacionalidade" type="text" class="form-control"
                                                    id="nacionalidade">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="provincia"
                                                class="col-md-4 col-lg-3 col-form-label">Província</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="provincia" name="provincia" type="text" class="form-control"
                                                    id="provincia">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="endereco"
                                                class="col-md-4 col-lg-3 col-form-label">Endereço</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="endereco" name="endereco" type="text" class="form-control"
                                                    id="endereco">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="twitter" class="col-md-4 col-lg-3 col-form-label">Twitter</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="twitter" name="twitter" type="text" class="form-control"
                                                    id="twitter" >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                </label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="facebook" name="facebook" type="text" class="form-control"
                                                    id="facebook" >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                </label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="instagram" name="instagram" type="text" class="form-control"
                                                    id="instagram" >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                </label>
                                            <div class="col-md-8 col-lg-9">
                                                <input wire:model="linkedin" name="linkedin" type="text" class="form-control"
                                                    id="linkedin">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button wire:click="actualizarDadosPerfil" type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                                
                                {{-- Palavra-Passe Configurações --}}
                                <div class="tab-pane fade pt-3 {{$tabConteudoEditarPasse}}" id="profile-change-password">
                                    <form wire:submit.prevent="alterarPalavraPasse">
                                        <div class="row mb-3">
                                            <label for="passeActual" class="col-md-4 col-lg-3 col-form-label">Passe
                                                Actual</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input  type="password" class="form-control"
                                                    wire:model="passeActual" id="passeActual" >
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
                                                <input  type="password" class="form-control"
                                                    wire:model="passeNova" id="passeNova" >
                                                    <div class="text-danger pt-2" style="font-size: 12.5px">
                                                        @error('passeNova')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="passeConfirmacao"
                                                class="col-md-4 col-lg-3 col-form-label">Confirmar Nova Passe</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="password" class="form-control"
                                                    wire:model="passeConfirmacao" id="passeConfirmacao" >
                                                    <div class="text-danger pt-2" style="font-size: 12.5px">
                                                        @error('passeConfirmacao')
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" 
                                                class="btn btn-primary">Alterar
                                                Palavra-passe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
