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
                                    <a href="{{ url('storage/' . $foto->caminho_arquivo) }}"
                                        style="display: inline-block; width: inherit; height: inherit">
                                        <img src="{{ url('storage/' . $foto->caminho_arquivo) }}" class="rounded-circle"
                                            alt="foto" style="width: inherit; height: inherit; object-fit: cover;">
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
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Visão Geral</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar
                                        Perfil</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-settings">Configurações</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Alterar Palavra-passe</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores
                                        cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt
                                        iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea
                                        saepe at unde.</p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">Kevin Anderson</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Company</div>
                                        <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Job</div>
                                        <div class="col-lg-9 col-md-8">Web Designer</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Country</div>
                                        <div class="col-lg-9 col-md-8">USA</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <form>
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Imagem do
                                                perfil
                                            </label>
                                            <div class="col-md-8 col-lg-9">


                                                <div class="col"
                                                    style="display: inline-block; width: 120px; height: 120px;">
                                                    @if ($foto)
                                                        <a href="{{ url('storage/' . $foto->caminho_arquivo) }}"
                                                            style="display: inline-block; width: inherit; height: inherit">
                                                            <img src="{{ url('storage/' . $foto->caminho_arquivo) }}"
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
                                                            id="file-input" style="display: none;">
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
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullName" type="text" class="form-control"
                                                    id="fullName" value="Kevin Anderson">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="about"
                                                class="col-md-4 col-lg-3 col-form-label">About</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company"
                                                class="col-md-4 col-lg-3 col-form-label">Company</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="company" type="text" class="form-control"
                                                    id="company" value="Lueilwitz, Wisoky and Leuschke">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="job" type="text" class="form-control"
                                                    id="Job" value="Web Designer">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Country"
                                                class="col-md-4 col-lg-3 col-form-label">Country</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="country" type="text" class="form-control"
                                                    id="Country" value="USA">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address"
                                                class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control"
                                                    id="Address" value="A108 Adam Street, New York, NY 535022">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone"
                                                class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control"
                                                    id="Phone" value="(436) 486-3538 x29071">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email"
                                                class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control"
                                                    id="Email" value="k.anderson@example.com">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter" type="text" class="form-control"
                                                    id="Twitter" value="https://twitter.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control"
                                                    id="Facebook" value="https://facebook.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control"
                                                    id="Instagram" value="https://instagram.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkedin" type="text" class="form-control"
                                                    id="Linkedin" value="https://linkedin.com/#">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-settings">
                                    <form>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                                Notifications</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade"
                                                        checked>
                                                    <label class="form-check-label" for="changesMade">
                                                        Changes made to your account
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts"
                                                        checked>
                                                    <label class="form-check-label" for="newProducts">
                                                        Information on new products and services
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Marketing and promo offers
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="securityNotify" checked disabled>
                                                    <label class="form-check-label" for="securityNotify">
                                                        Security alerts
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form action="/utilizador/alterar_palavra_passe" >
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="passeActual"
                                                class="col-md-4 col-lg-3 col-form-label">Passe Actual</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="passeActual" type="password" class="form-control"
                                                    wire:model="passeActual" id="passeActual">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="passeNova" class="col-md-4 col-lg-3 col-form-label">Nova
                                                Passe</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="passeNova" type="password" class="form-control"
                                                    wire:model="passeNova" id="passeNova">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="passeConfirmacao"
                                                class="col-md-4 col-lg-3 col-form-label">Confirmar Nova Passe</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="passeConfirmacao" type="password" class="form-control"
                                                    wire:model="passeConfirmacao" id="passeConfirmacao">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" {{--wire:click.prevent="alterarPalavraPasse"--}}
                                                class="btn btn-primary">Alterar
                                                Palavra-passe</button>
                                        </div>
                                    </form>

                                    @include('livewire.utilizador.alterar-passe')
                                    <script src="{{asset('assets/js/parar_livewire_passe.js')}}"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

