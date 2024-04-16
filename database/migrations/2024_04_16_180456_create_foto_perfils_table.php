<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoPerfilsTable extends Migration
{
    
    public function up()
    {
        Schema::create('foto_perfils', function (Blueprint $table) {
            $table->id();
            $table->string('caminho_arquivo')->nullable();
            $table->string('tipo_arquivo')->nullable();
            $table->string('nome_arquivo')->nullable();
            $table->string('extensao_arquivo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('foto_perfils');
    }
}
