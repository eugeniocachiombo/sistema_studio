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
    public function run()
    {
        \App\Models\User::factory(20)->create();
        \App\Models\chat\Conversa::factory(30)->create();
        \App\Models\Participante\Participante::factory(10)->create();
        \App\Models\Gravacao\Gravacao::factory(100)->create();
        \App\Models\Mixagem\Mixagem::factory(100)->create();
        \App\Models\Masterizacao\Masterizacao::factory(100)->create();
    }
}
