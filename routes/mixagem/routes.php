<?php

use App\Http\Livewire\Mixagem\Actualizar;
use App\Http\Livewire\Mixagem\Agendar;
use App\Http\Livewire\Mixagem\Concluir;
use App\Http\Livewire\Mixagem\Listar;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("mixagem")->name("mixagem.")->group(function () {
    Route::get('agendar', Agendar::class)->name("agendar")->middleware(CheckAuth::class);
    Route::get('actualizar/{id}', Actualizar::class)->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', Listar::class)->name("listar")->middleware(CheckAuth::class);
    Route::get('concluir', Concluir::class)->name("concluir")->middleware(CheckAuth::class);
});