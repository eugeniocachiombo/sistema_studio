<?php

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
use App\Http\Livewire\Mixagem\Listar as ListarMixagem;

use App\Http\Livewire\Utilizador\Anonimo;
use App\Http\Livewire\Utilizador\Autenticacao;
use App\Http\Livewire\Utilizador\Cadastro;
use App\Http\Livewire\Utilizador\Perfil;
use App\Http\Livewire\Utilizador\PrepararAmbiente;
use App\Http\Livewire\Utilizador\TerminarSessao;

use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Chat\Conversa;
use App\Http\Livewire\Estilos\Actualizar as EstilosActualizar;
use App\Http\Livewire\Estilos\Adicionar;
use App\Http\Livewire\Estilos\Listar as EstilosListar;
use App\Http\Livewire\Grupos\Actualizar as GruposActualizar;
use App\Http\Livewire\Grupos\Criar;
use App\Http\Livewire\Grupos\Listar as GruposListar;
use App\Http\Livewire\PaginaInicial\PaginaInicial;
use App\Http\Livewire\RecuperarConta\RecuperarConta;
use App\Http\Livewire\Utilizador\ActualizarAcesso;
use App\Http\Livewire\Utilizador\ListaAtendentes;
use App\Http\Livewire\Utilizador\ListaClientes;
use App\Http\Livewire\Utilizador\ListaTodos;
use App\Models\User;
use App\Models\Utilizador\Pessoa;

Route::prefix("pagina_inicial")->name("pagina_inicial.")->group(function () {
    Route::get('/', [PaginaInicial::class, "index"])->name("")->middleware(CheckAuth::class);
});

Route::prefix("recuperar_conta")->name("recuperar_conta.")->group(function () {
    Route::get('/', [RecuperarConta::class, "index"])->name("");
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
    Route::get('anonimo/{id}', [Anonimo::class, "index"])->name("anonimo")->middleware(CheckAuth::class);
    Route::get('listagem/todos', [ListaTodos::class, "index"])->name("listagem.todos")->middleware(CheckAuth::class);
    Route::get('listagem/clientes', [ListaClientes::class, "index"])->name("listagem.clientes")->middleware(CheckAuth::class);
    Route::get('listagem/atendentes', [ListaAtendentes::class, "index"])->name("listagem.atendentes")->middleware(CheckAuth::class);
    Route::get('actualizar_acesso/{id}', [ActualizarAcesso::class, "index"])->name("actualizar_acesso")->middleware(CheckAuth::class);
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

Route::prefix("grupo")->name("grupo.")->group(function () {
    Route::get('criar', [Criar::class, "index"])->name("criar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idGrupo}', [GruposActualizar::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [GruposListar::class, "index"])->name("listar")->middleware(CheckAuth::class);
});

Route::prefix("estilos")->name("estilos.")->group(function () {
    Route::get('adicionar', [Adicionar::class, "index"])->name("adicionar")->middleware(CheckAuth::class);
    Route::get('actualizar/{idEstilo}', [EstilosActualizar::class, "index"])->name("actualizar")->middleware(CheckAuth::class);
    Route::get('listar', [EstilosListar::class, "index"])->name("listar")->middleware(CheckAuth::class);
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
Route::get("/erro_data", function () {return view("index.erro_de_pagina.data-erro");});
Route::fallback(function () {return view("index.erro_de_pagina.pagina-de-erro");});

Route::get("/migrate", function () {
    Artisan::call('migrate');
    return "Base de dados emigrado";
});

Route::get("/seed", function () {
    \Database\Seeders\DatabaseSeeder::run();
    return "Informações faker inseridos na Base de dados";
});

Route::get("/truncate", function () {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    DB::statement("truncate gravacaos");
    DB::statement("truncate mixagems");
    DB::statement("truncate masterizacaos");
    DB::statement("truncate conversas");
    DB::statement("truncate codigo_confirmacaos");
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
    return "Base de dados limpado (gravações, mixagens, masterizações, conversas, codigo_confirmacaos)";
});

Route::get("/drop", function () {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    Artisan::call('migrate:reset');
    DB::statement('DROP TABLE IF EXISTS migrations');
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
    return "Base de dados limpeza total";
});