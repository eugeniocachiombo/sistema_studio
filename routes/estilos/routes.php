<?php

use App\Http\Livewire\Estilos\Actualizar as EstilosActualizar;
use App\Http\Livewire\Estilos\Adicionar;
use App\Http\Livewire\Estilos\Listar as EstilosListar;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("estilos")->name("estilos.")->group(function () {
    Route::get('adicionar', [Adicionar::class, "index"])->name("adicionar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idEstilo}', [EstilosActualizar::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [EstilosListar::class, "index"])->name("listar")->middleware(CheckAuth::class);
});