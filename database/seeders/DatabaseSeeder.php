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
        \App\Models\User::factory(50)->create();
        \App\Models\chat\Conversa::factory(100)->create();
        \App\Models\Gravacao\Gravacao::factory(100)->create();
        \App\Models\Mixagem\Mixagem::factory(100)->create();
        \App\Models\Masterizacao\Masterizacao::factory(100)->create();
    }
}
