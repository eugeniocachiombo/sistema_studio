<?php

use App\Http\Livewire\Chat\Conversa;
use App\Http\Livewire\Gravacao\Actualizar;
use App\Http\Livewire\Gravacao\Agendar;
use App\Http\Livewire\Gravacao\Concluir;
use App\Http\Livewire\Gravacao\Listar;
use App\Http\Livewire\Info\Ajuda;
use App\Http\Livewire\Info\Contacto;

use App\Http\Livewire\Masterizacao\Actualizar as ActualizarMasterizacao;
use App\Http\Livewire\Masterizacao\Agendar as AgendarMasterizacao;
use App\Http\Livewire\Masterizacao\Concluir as ConcluirMasterizacao;
use App\Http\Livewire\Masterizacao\Listar as ListarMasterizacao;
use App\Http\Livewire\Mixagem\Actualizar as ActualizarMixagem;
use App\Http\Livewire\Mixagem\Agendar as AgendarMixagem;
use App\Http\Livewire\Mixagem\Concluir as ConcluirMixagem;

use App\Http\Livewire\Mixagem\Listar as ListarMixagem;use App\Http\Livewire\PaginaInicial\PaginaInicial;
use App\Http\Livewire\Utilizador\Autenticacao;
use App\Http\Livewire\Utilizador\Cadastro;

use App\Http\Livewire\Utilizador\Perfil;
use App\Http\Livewire\Utilizador\PrepararAmbiente;
use App\Http\Livewire\Utilizador\TerminarSessao;use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Artisan;use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Route;

Route::prefix("pagina_inicial")->name("pagina_inicial.")->group(function () {
    Route::get('/', [PaginaInicial::class, "index"])->name("")->middleware(CheckAuth::class);
});

Route::prefix("info")->name("info.")->group(function () {
    Route::get('ajuda', [Ajuda::class, "index"])->name("ajuda");
    Route::get('contacto', [Contacto::class, "index"])->name("contacto");
});

Route::prefix("utilizador")->name("utilizador.")->group(function () {
    Route::get('cadastro', [Cadastro::class, "index"])->name("cadastro");
    Route::get('autenticacao', [Autenticacao::class, "index"])->name("autenticacao");
    Route::get('perfil', [Perfil::class, "index"])->name("perfil")->middleware(CheckAuth::class);
    Route::get('terminar_sessao', [TerminarSessao::class, "index"])->name("terminar_sessao")->middleware(CheckAuth::class);
    Route::get('preparar_ambiente', [PrepararAmbiente::class, "index"])->name("preparar_ambiente");
    Route::get('alterar_palavra_passe', [Perfil::class, "alterarPalavraPasse"])->name("alterar_palavra_passe")->middleware(CheckAuth::class);
});

Route::prefix("chat")->name("chat.")->group(function () {
    Route::get('conversa/{utilizador}/{remente}', [Conversa::class, "index"])->name("conversa")->middleware(CheckAuth::class);
});

Route::prefix("gravacao")->name("gravacao.")->group(function () {
    Route::get('agendar', [Agendar::class, "index"])->name("agendar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idGravacao}', [Actualizar::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [Listar::class, "index"])->name("listar")->middleware(CheckAuth::class);
    Route::get('concluir', [Concluir::class, "index"])->name("concluir")->middleware(CheckAuth::class);
});

Route::prefix("mixagem")->name("mixagem.")->group(function () {
    Route::get('agendar', [AgendarMixagem::class, "index"])->name("agendar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idMixagem}', [ActualizarMixagem::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [ListarMixagem::class, "index"])->name("listar")->middleware(CheckAuth::class);
    Route::get('concluir', [ConcluirMixagem::class, "index"])->name("concluir")->middleware(CheckAuth::class);
});

Route::prefix("masterizacao")->name("masterizacao.")->group(function () {
    Route::get('agendar', [AgendarMasterizacao::class, "index"])->name("agendar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idMasterizacao}', [ActualizarMasterizacao::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [ListarMasterizacao::class, "index"])->name("listar")->middleware(CheckAuth::class);
    Route::get('concluir', [ConcluirMasterizacao::class, "index"])->name("concluir")->middleware(CheckAuth::class);
});

Route::get("/", function () {return redirect()->route("utilizador.autenticacao");});
Route::fallback(function () {return view("index.erro_de_pagina.pagina-de-erro");});

Route::get("/migrate", function () {
    Artisan::call('migrate');
    return "Base de dados emigrado";
});

Route::get("/seed", function () {
    \App\Models\User::factory(20)->create();
    \App\Models\chat\Conversa::factory(rand(5, 20))->create();
    \App\Models\Participante\Participante::factory(rand(1, 10))->create();
    \App\Models\Gravacao\Gravacao::factory(rand(5, 20))->create();
    \App\Models\Mixagem\Mixagem::factory(rand(5, 20))->create();
    \App\Models\Masterizacao\Masterizacao::factory(rand(5, 20))->create();
    return "Informações faker inseridos na Base de dados";
});

Route::get("/truncate", function () {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    DB::statement("truncate gravacaos");
    DB::statement("truncate mixagems");
    DB::statement("truncate masterizacaos");
    DB::statement("truncate conversas");
    DB::statement("truncate registro_actividades");
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
    return "Base de dados limpado (gravações, mixagens, masterizações, conversas, registro_actividades)";
});
