<?php

use App\Http\Livewire\PaginaInicial\PaginaInicial;
use App\Http\Livewire\RecuperarConta\RecuperarConta;
use App\Http\Livewire\Info\Ajuda;
use App\Http\Livewire\Info\Contacto;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("pagina_inicial")->name("pagina_inicial.")->group(function () {
    Route::get('/', PaginaInicial::class)->name("")->middleware(CheckAuth::class);
});

Route::prefix("recuperar_conta")->name("recuperar_conta.")->group(function () {
    Route::get('/', RecuperarConta::class)->name("");
});

Route::prefix("info")->name("info.")->group(function () {
    Route::get('ajuda', Ajuda::class)->name("ajuda");
    Route::get('contacto', Contacto::class)->name("contacto");
});

Route::get("/", function () {
    return redirect()->route("utilizador.autenticacao");
});

Route::get("/erro_data", function () {
    return view("erro_de_pagina.data-erro");
});

Route::fallback(function () {
    return view("erro_de_pagina.pagina-de-erro");
});