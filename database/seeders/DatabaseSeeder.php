<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(20)->create();
        \App\Models\chat\Conversa::factory(rand(5, 20))->create();
        \App\Models\Participante\Participante::factory(rand(1, 10))->create();
        \App\Models\Gravacao\Gravacao::factory(rand(5, 20))->create();
        \App\Models\Mixagem\Mixagem::factory(rand(5, 20))->create();
        \App\Models\Masterizacao\Masterizacao::factory(rand(5, 20))->create();
        \App\Models\Utilizador\Pessoa::factory(rand(5, 20))->create();
    }
}
