<?php

use App\Http\Livewire\Chat\Conversa;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

Route::prefix("chat")->name("chat.")->group(function () {
    Route::get('conversa/{utilizador}/{remente}', Conversa::class)->name("conversa")->middleware(CheckAuth::class);
});