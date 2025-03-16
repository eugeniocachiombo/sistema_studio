<?php

use App\Http\Livewire\Grupos\Actualizar;
use App\Http\Livewire\Grupos\Criar;
use App\Http\Livewire\Grupos\Listar;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("grupo")->name("grupo.")->group(function () {
    Route::get('criar', Criar::class)->name("criar")->middleware(CheckAuth::class);
    Route::get('actualizar/{id}', Actualizar::class)->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', Listar::class)->name("listar")->middleware(CheckAuth::class);
});