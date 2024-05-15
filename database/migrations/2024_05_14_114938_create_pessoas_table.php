<?php

use App\Models\Utilizador\Pessoa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->string('sobrenome')->nullable();
            $table->enum('genero', ['M', 'F'])->default('M');
            $table->date('nascimento')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('sobre')->nullable();
            $table->string('nacionalidade')->nullable();
            $table->string('provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('endereco')->nullable();
            $table->string('twiter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
        });

        Pessoa::create([
            "nome" => "Conta",
            "sobrenome" => "Produtor",
            "genero" => "M",
            "nascimento" => "1999-04-24",
            "user_id" => 1
        ]);
        Pessoa::create([
            "nome" => "Conta",
            "sobrenome" => "Atendente",
            "genero" => "F",
            "nascimento" => "1999-04-24",
            "user_id" => 2
        ]);
        Pessoa::create([
            "nome" => "Conta",
            "sobrenome" => "Cantor",
            "genero" => "M",
            "nascimento" => "1999-04-24",
            "user_id" => 3
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
