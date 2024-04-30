<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Gravação</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Gravação</a></li>
                    <li class="breadcrumb-item active">Agendamento</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <div class="row gy-4 d-table d-md-flex">
                {{-- Coluna 1 --}}
                <div class="col">
                    {{-- Cliente --}}
                    <div class="card card-animated p-4">
                        <label class="text-primary fw-bold" for="">Cliente</label>
                        <select class="form-control" name="" id="" required>
                            <option class="d-none">Escolha o cliente</option>
                        </select>
                    </div>

                    {{-- Grupo --}}
                    <div class="card card-animated p-4 ">
                        <div class="d-table d-md-flex justify-content-between">
                            <div class="col m-3">
                                <form class="row g-3">
                                    <label class="text-primary fw-bold" for="">Grupo</label> <br>
                                    <input type="text" name="" id="" class="form-control"
                                        placeholder="Nome do grupo">
                                    <button class="btn btn-primary">
                                        Criar
                                    </button>
                                </form>
                            </div>

                            <div class="col m-3">
                                <label class="text-primary fw-bold" for="">Escolher</label>
                                <select required class="form-control mt-3" name="" id="">
                                    <option class="d-none">Selecione o grupo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Participante --}}
                    <div class="card card-animated p-4 d-table d-md-flex">
                        <div class="col">
                            <form action="" class="row g-3">
                                <label class="text-primary fw-bold" for="">Participante</label> <br>
                                <input type="text" name="" id="" class="form-control"
                                    placeholder="Escreva o nome do participante">
                                <button class="btn btn-primary">
                                    Registrar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Coluna 2 --}}
                <div class="col">
                    {{-- Lista de participantes --}}
                    <div class="card card-animated p-4 d-table d-md-flex">
                        <label class="text-primary fw-bold" for="">Lista dos Participantes</label> <br>
                        <div class="col table-responsive">
                            <table class="border border-dark table table-hover table-primary">
                                <thead class="border border-dark">
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Nome do Particiapante
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="border border-dark">
                                    <tr>
                                        <th>
                                            Vazio
                                        </th>
                                        <th>
                                            Vazio
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Descrição do Agendamento --}}
                    <div class="card card-animated p-4 ">
                        <div class="col d-table d-md-flex justify-content-between">
                            <div class="col m-3">
                                <div class="row g-3">
                                    <label class="text-primary fw-bold" for="">Título do Audio</label> <br>
                                    <input type="text" name="" id="" class="form-control"
                                        placeholder="Escreva o título">
                                </div>
                            </div>

                            <div class="col m-3">
                                <label class="text-primary fw-bold" for="">Estilo</label>
                                <select class="form-control mt-3" name="" id="">
                                    <option class="d-none">Selecione o estilo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col d-table d-md-flex justify-content-between">
                            <div class="col m-3">
                                <div class="row g-3">
                                    <label class="text-primary fw-bold" for="">Data da gravação</label> <br>
                                    <input type="datetime-local" name="" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col m-3">
                                <label class="text-primary fw-bold" for="">Duração da gravação</label>
                                <select class="form-control mt-3" name="" id="">
                                    <option class="d-none">Selecione o estilo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col d-table d-md-flex justify-content-between">
                            <div class="col m-3">
                                <button class="btn btn-primary">
                                    Agendar Gravação
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
