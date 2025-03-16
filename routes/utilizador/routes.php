<?php

use App\Http\Middleware\CheckAuth;
use App\Http\Livewire\Utilizador\ActualizarAcesso;
use App\Http\Livewire\Utilizador\ListaAtendentes;
use App\Http\Livewire\Utilizador\ListaClientes;
use App\Http\Livewire\Utilizador\ListaTodos;
use App\Http\Livewire\Utilizador\Anonimo;
use App\Http\Livewire\Utilizador\Autenticacao;
use App\Http\Livewire\Utilizador\Cadastro;
use App\Http\Livewire\Utilizador\Perfil;
use App\Http\Livewire\Utilizador\PrepararAmbiente;
use App\Http\Livewire\Utilizador\TerminarSessao;
use Illuminate\Support\Facades\Route;

Route::prefix("utilizador")->name("utilizador.")->group(function () {
    Route::get('cadastro', [Cadastro::class, "index"])->name("cadastro");
    Route::get('autenticacao', [Autenticacao::class, "index"])->name("autenticacao");
    Route::get('perfil', [Perfil::class, "index"])->name("perfil")->middleware(CheckAuth::class);
    Route::get('terminar_sessao', [TerminarSessao::class, "index"])->name("terminar_sessao")->middleware(CheckAuth::class);
    Route::get('preparar_ambiente', [PrepararAmbiente::class, "index"])->name("preparar_ambiente");
    Route::get('anonimo/{id}', [Anonimo::class, "index"])->name("anonimo")->middleware(CheckAuth::class);
    Route::get('listagem/todos', [ListaTodos::class, "index"])->name("listagem.todos")->middleware(CheckAuth::class);
    Route::get('listagem/clientes', [ListaClientes::class, "index"])->name("listagem.clientes")->middleware(CheckAuth::class);
    Route::get('listagem/atendentes', [ListaAtendentes::class, "index"])->name("listagem.atendentes")->middleware(CheckAuth::class);
    Route::get('actualizar_acesso/{id}', [ActualizarAcesso::class, "index"])->name("actualizar_acesso")->middleware(CheckAuth::class);
});