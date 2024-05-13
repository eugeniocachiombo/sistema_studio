<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('pagina_inicial.') }}" class="logo d-flex align-items-center">
            <img src="{{asset('assets/img/logo.png')}}" alt="">
            <span class="d-none d-lg-block">@include('inclusao.nomesite')</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    @livewire('inclusao.pesquisa')
    @livewire('inclusao.header')
</header>

@livewire('chat.listamodal')
@livewire('chat.funcionarios-modal')
@livewire('inclusao.header-inclusao.modal-notificacoes')