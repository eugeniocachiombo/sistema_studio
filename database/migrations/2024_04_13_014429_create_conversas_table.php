<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emissor');
            $table->unsignedBigInteger('receptor');
            $table->enum('estado', ['lido', 'pendente'])->default('pendente');
            $table->text('mensagem');
            $table->string('caminho_arquivo')->nullable();
            $table->string('tipo_arquivo')->nullable();
            $table->string('nome_arquivo')->nullable();
            $table->string('extensao_arquivo')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('emissor')->references('id')->on('users');
            $table->foreign('receptor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversas');
    }
}
