<div class="tab-pane fade {{ $tabConteudoVisaoGeral }} profile-overview" id="profile-overview">
    <h5 class="card-title">Sobre</h5>
    <p class="small fst-italic">
        {{ $dadosPessoais->sobre != null ? $dadosPessoais->sobre : 'Sem informação' }}</p>

    <h5 class="card-title">Detalhes do Perfil</h5>

    @if (\Illuminate\Support\Facades\Auth::user()->id == $utilizador->id)
    <div class="row">
        <div class="col-lg-3 col-md-4 label ">Identificador: {{ $dadosPessoais->id }}</div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-3 col-md-4 label ">Nome Completo</div>
        <div class="col-lg-9 col-md-8">{{ ucwords($dadosPessoais->nome) }}
            {{ ucwords($dadosPessoais->sobrenome) }}</div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Nome Artístico</div>
        <div class="col-lg-9 col-md-8">{{ ucwords($utilizador->name) }}</div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Gênero</div>
        <div class="col-lg-9 col-md-8">
            {{ $dadosPessoais->genero == 'M' ? 'Masculino' : 'Femenino' }}</div>
    </div>

    @if (\Illuminate\Support\Facades\Auth::user()->id == $utilizador->id)
        <div class="row">
            <div class="col-lg-3 col-md-4 label">Nascimento</div>
            <div class="col-lg-9 col-md-8">{{ $nascimento }}</div>
        </div>
    @endif

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
            {{ $dadosPessoais->nacionalidade != null ? ucwords($dadosPessoais->nacionalidade) : 'Sem informação' }}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Morada</div>
        @php
            $provincia = $dadosPessoais->provincia != null ? ucwords($dadosPessoais->provincia) : 'Sem informação';
            $municipio = $dadosPessoais->municipio != null ? ucwords($dadosPessoais->municipio) : 'Sem informação';
            $endereco = $dadosPessoais->endereco != null ? ucwords($dadosPessoais->endereco) : 'Sem informação';
        @endphp
        <div class="col-lg-9 col-md-8">{{ $provincia }}, {{ $municipio }},
            {{ $endereco }}</div>
    </div>
</div>
