<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;
use App\Http\Livewire\PaginaInicial\PaginaInicial;
use App\Http\Livewire\Info\{
    Ajuda,
    Contacto
};
use App\Http\Livewire\Chat\{
    Conversa
};
use App\Http\Livewire\Utilizador\{
    Cadastro,
    Autenticacao,
    Perfil,
    TerminarSessao,
    PrepararAmbiente
};
use App\Http\Livewire\Gravacao\{
    Agendar,
    Actualizar,
    Listar,
    Concluir
};



Route::prefix("pagina_inicial")->name("pagina_inicial.")->group(function(){
    Route::get('/', [PaginaInicial::class, "index"])->name("")->middleware(CheckAuth::class);
});

Route::prefix("info")->name("info.")->group(function(){
    Route::get('ajuda', [Ajuda::class, "index"])->name("ajuda");
    Route::get('contacto', [Contacto::class, "index"])->name("contacto");
});

Route::prefix("utilizador")->name("utilizador.")->group(function(){
    Route::get('cadastro', [Cadastro::class, "index"])->name("cadastro");
    Route::get('autenticacao', [Autenticacao::class, "index"])->name("autenticacao");
    Route::get('perfil', [Perfil::class, "index"])->name("perfil")->middleware(CheckAuth::class);
    Route::get('terminar_sessao', [TerminarSessao::class, "index"])->name("terminar_sessao")->middleware(CheckAuth::class);
    Route::get('preparar_ambiente', [PrepararAmbiente::class, "index"])->name("preparar_ambiente");
    Route::get('alterar_palavra_passe', [Perfil::class, "alterarPalavraPasse"])->name("alterar_palavra_passe")->middleware(CheckAuth::class);
});

Route::prefix("gravacao")->name("gravacao.")->group(function(){
   Route::get('agendar', [Agendar::class, "index"])->name("agendar")->middleware(CheckAuth::class);
   Route::get('actualizar/{idGravacao}', [Actualizar::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
   Route::get('listar', [Listar::class, "index"])->name("listar")->middleware(CheckAuth::class);
   Route::get('concluir', [Concluir::class, "index"])->name("concluir")->middleware(CheckAuth::class);
});

Route::prefix("chat")->name("chat.")->group(function(){
    Route::get('conversa/{utilizador}/{remente}', [Conversa::class, "index"])->name("conversa")->middleware(CheckAuth::class);
});

Route::get("/", function (){ return redirect()->route("utilizador.autenticacao"); });
Route::fallback(function (){ return view("index.erro_de_pagina.pagina-de-erro"); });


