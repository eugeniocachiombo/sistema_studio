<?php

use App\Http\Livewire\Grupos\Actualizar as GruposActualizar;
use App\Http\Livewire\Grupos\Criar;
use App\Http\Livewire\Grupos\Listar as GruposListar;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("grupo")->name("grupo.")->group(function () {
    Route::get('criar', [Criar::class, "index"])->name("criar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idGrupo}', [GruposActualizar::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [GruposListar::class, "index"])->name("listar")->middleware(CheckAuth::class);
});