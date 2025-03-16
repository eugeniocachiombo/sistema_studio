<?php

use App\Http\Livewire\Gravacao\Actualizar;
use App\Http\Livewire\Gravacao\Agendar;
use App\Http\Livewire\Gravacao\Concluir;
use App\Http\Livewire\Gravacao\Listar;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("gravacao")->name("gravacao.")->group(function () {
    Route::get('agendar', [Agendar::class, "index"])->name("agendar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idGravacao}', [Actualizar::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [Listar::class, "index"])->name("listar")->middleware(CheckAuth::class);
    Route::get('concluir', [Concluir::class, "index"])->name("concluir")->middleware(CheckAuth::class);
});