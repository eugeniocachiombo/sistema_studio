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
    Route::get('cadastro', Cadastro::class)->name("cadastro");
    Route::get('autenticacao', Autenticacao::class)->name("autenticacao");
    Route::get('perfil', Perfil::class)->name("perfil")->middleware(CheckAuth::class);
    Route::get('terminar_sessao', TerminarSessao::class)->name("terminar_sessao")->middleware(CheckAuth::class);
    Route::get('preparar_ambiente', PrepararAmbiente::class)->name("preparar_ambiente");
    Route::get('anonimo/{id}', Anonimo::class)->name("anonimo")->middleware(CheckAuth::class);
    Route::get('listagem/todos', ListaTodos::class)->name("listagem.todos")->middleware(CheckAuth::class);
    Route::get('listagem/clientes', ListaClientes::class)->name("listagem.clientes")->middleware(CheckAuth::class);
    Route::get('listagem/atendentes', ListaAtendentes::class)->name("listagem.atendentes")->middleware(CheckAuth::class);
    Route::get('actualizar_acesso/{id}', ActualizarAcesso::class)->name("actualizar_acesso")->middleware(CheckAuth::class);
});