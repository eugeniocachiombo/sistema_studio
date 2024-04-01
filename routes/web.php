<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PaginaInicial\PaginaInicial;
use App\Http\Livewire\Utilizador\{
    Cadastro,
    Autenticacao,
    Perfil
};

Route::fallback(function (){ return view("index.erro_de_pagina.pagina-de-erro"); });
Route::get('/pagina_inicial', [PaginaInicial::class, "index"]);

Route::prefix("utilizador")->name("utilizador.")->group(function(){
    Route::get('cadastro', [Cadastro::class, "index"])->name("cadastro");
    Route::get('autenticacao', [Autenticacao::class, "index"])->name("autenticacao");
    Route::get('perfil', [Perfil::class, "index"])->name("perfil");
});




