<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PaginaInicial\PaginaInicial;
use App\Http\Livewire\Info\Informacoes;
use App\Http\Livewire\Utilizador\{
    Cadastro,
    Autenticacao,
    Perfil
};

Route::prefix("info")->name("info.")->group(function(){
    Route::get('ajuda', [Informacoes::class, "ajuda"])->name("ajuda");
    Route::get('contacto', [Informacoes::class, "contacto"])->name("contacto");
});

Route::prefix("utilizador")->name("utilizador.")->group(function(){
    Route::get('cadastro', [Cadastro::class, "index"])->name("cadastro");
    Route::get('autenticacao', [Autenticacao::class, "index"])->name("autenticacao");
    Route::get('perfil', [Perfil::class, "index"])->name("perfil");
});

Route::get('/pagina_inicial', [PaginaInicial::class, "index"]);
Route::get("/", function (){ return redirect()->route("utilizador.autenticacao"); });
Route::fallback(function (){ return view("index.erro_de_pagina.pagina-de-erro"); });



