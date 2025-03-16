@include('inclusao.headHtml')
<title>@yield('titulo')</title>
<main>
   {{$slot}}
</main>
@include('inclusao.footHtml')