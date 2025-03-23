<?php

use App\Http\Livewire\Gravacao\Actualizar;
use App\Http\Livewire\Gravacao\Agendar;
use App\Http\Livewire\Gravacao\Concluir;
use App\Http\Livewire\Gravacao\Listar;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("gravacao")->name("gravacao.")->group(function () {
    Route::get('agendar', Agendar::class)->name("agendar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idGravacao}', Actualizar::class)->name("actualizar")->middleware(CheckAuth::class);
    Route::get('lista', Listar::class)->name("listar")->middleware(CheckAuth::class);
    Route::get('concluidas', Concluir::class)->name("concluir")->middleware(CheckAuth::class);
});