<?php

use App\Http\Livewire\Mixagem\Actualizar as ActualizarMixagem;
use App\Http\Livewire\Mixagem\Agendar as AgendarMixagem;
use App\Http\Livewire\Mixagem\Concluir as ConcluirMixagem;
use App\Http\Livewire\Mixagem\Listar as ListarMixagem;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("mixagem")->name("mixagem.")->group(function () {
    Route::get('agendar', [AgendarMixagem::class, "index"])->name("agendar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idMixagem}', [ActualizarMixagem::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [ListarMixagem::class, "index"])->name("listar")->middleware(CheckAuth::class);
    Route::get('concluir', [ConcluirMixagem::class, "index"])->name("concluir")->middleware(CheckAuth::class);
});