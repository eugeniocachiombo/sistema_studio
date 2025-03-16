<?php

use App\Http\Livewire\Estilos\Actualizar;
use App\Http\Livewire\Estilos\Adicionar;
use App\Http\Livewire\Estilos\Listar;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("estilos")->name("estilos.")->group(function () {
    Route::get('adicionar', Adicionar::class)->name("adicionar")->middleware(CheckAuth::class);
    Route::get('actualizar/{id}', Actualizar::class)->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', Listar::class)->name("listar")->middleware(CheckAuth::class);
});