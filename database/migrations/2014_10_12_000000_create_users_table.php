<?php

use App\Models\Participante\Participante;
use App\Models\User;
use App\Models\Utilizador\Pessoa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pessoa_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->bigInteger('telefone')->unique()->nullable();
            $table->unsignedBigInteger('tipo_acesso')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('tipo_acesso')->references('id')->on('acessos')->onDelete("cascade");
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete("cascade");
            $table->softDeletes();
        });

        User::create([
            'pessoa_id' => 1,
            'name' => "Conta Produtor",
            'email' => "produtor@example.com",
            'telefone' => 911911911,
            'email_verified_at' => now(), 
            'password' => Hash::make('123456'), 
            'tipo_acesso' => 1,
            'remember_token' => Str::random(10),
        ]);
        
        User::create([
            'pessoa_id' => 2,
            'name' => "Conta Atendente",
            'email' => "atendente@example.com",
            'telefone' => 922922922,
            'email_verified_at' => now(), 
            'password' => Hash::make('123456'), 
            'tipo_acesso' => 2,
            'remember_token' => Str::random(10),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
