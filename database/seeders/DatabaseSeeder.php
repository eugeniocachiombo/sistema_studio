<?php

namespace Database\Seeders;

use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\Pessoa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public static function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Utilizador\RedesSociais::factory(1)->create();
        \App\Models\chat\Conversa::factory(rand(5, 100))->create();
        \App\Models\Gravacao\Gravacao::factory(rand(5, 20))->create();
        \App\Models\Mixagem\Mixagem::factory(rand(5, 20))->create();
        \App\Models\Masterizacao\Masterizacao::factory(rand(5, 20))->create();
    }
}
