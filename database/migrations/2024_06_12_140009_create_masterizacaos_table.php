<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterizacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterizacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mixagem_id')->nullable();
            $table->dateTime('data_master')->nullable();
            $table->enum('estado_master', ['masterizado', 'pendente'])->default('pendente');
            $table->string('duracao')->nullable();
            $table->unsignedBigInteger('responsavel')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('mixagem_id')->references('id')->on('mixagems')->onDelete("cascade");
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
        Schema::dropIfExists('masterizacaos');
    }
}
