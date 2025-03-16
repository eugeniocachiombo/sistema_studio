<?php

use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    DB::statement("truncate registro_actividades");
    DB::statement("truncate codigo_confirmacaos");
    DB::statement("truncate clientes_aprovados");
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
    return "Base de dados limpado (gravações, mixagens, masterizações, conversas, registro_actividades, codigo_confirmacaos)";
});

Route::get("/drop", function () {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    Artisan::call('migrate:reset');
    DB::statement('DROP TABLE IF EXISTS migrations');
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
    return "Base de dados limpeza total";
});