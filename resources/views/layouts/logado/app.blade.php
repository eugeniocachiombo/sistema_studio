@include('inclusao.headHtml')
<title>@yield('titulo')</title>
<main>
    @include('inclusao.header')
    @include('inclusao.aside')
    {{$slot}}
    @include('inclusao.footer')
</main>
@include('inclusao.footHtml')