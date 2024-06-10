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
            $table->date('nascimento')->nullable()->default('1990-01-01');
            $table->text('sobre')->nullable()->default("Sem informação");
            $table->string('nacionalidade')->nullable()->default("Sem informação");
            $table->string('provincia')->nullable()->default("Sem informação");
            $table->string('municipio')->nullable()->default("Sem informação");
            $table->string('endereco')->nullable()->default("Sem informação");
            $table->string('twitter')->nullable()->default("https://twitter.com/#");
            $table->string('facebook')->nullable()->default("https://facebook.com/#");
            $table->string('instagram')->nullable()->default("https://instagram.com/#");
            $table->string('linkedin')->nullable()->default("https://linkedin.com/#");
            $table->timestamps();
            $table->softDeletes();
        });

        Pessoa::create([
            "nome" => "Conta",
            "sobrenome" => "Produtor",
            "genero" => "M",
            "nascimento" => "1999-04-24"
        ]);
        Pessoa::create([
            "nome" => "Conta",
            "sobrenome" => "Atendente",
            "genero" => "F",
            "nascimento" => "1999-04-24"
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
