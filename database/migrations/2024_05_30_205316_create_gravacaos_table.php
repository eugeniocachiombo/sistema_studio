<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGravacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gravacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->string('titulo_audio')->nullable();
            $table->unsignedBigInteger('estilo_audio')->nullable();
            $table->dateTime('data_gravacao')->nullable();
            $table->enum('estado_gravacao', ['gravado', 'pendente'])->default('pendente');
            $table->string('duracao')->nullable();
            $table->unsignedBigInteger('responsavel')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete("cascade");
            $table->foreign('estilo_audio')->references('id')->on('estilos')->onDelete("cascade");
            $table->foreign('responsavel')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gravacaos');
    }
}
