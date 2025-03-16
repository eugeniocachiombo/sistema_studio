<?php

use App\Http\Livewire\Masterizacao\Actualizar as ActualizarMasterizacao;
use App\Http\Livewire\Masterizacao\Agendar as AgendarMasterizacao;
use App\Http\Livewire\Masterizacao\Concluir as ConcluirMasterizacao;
use App\Http\Livewire\Masterizacao\Listar as ListarMasterizacao;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("masterizacao")->name("masterizacao.")->group(function () {
    Route::get('agendar', [AgendarMasterizacao::class, "index"])->name("agendar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idMasterizacao}', [ActualizarMasterizacao::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [ListarMasterizacao::class, "index"])->name("listar")->middleware(CheckAuth::class);
    Route::get('concluir', [ConcluirMasterizacao::class, "index"])->name("concluir")->middleware(CheckAuth::class);
});
