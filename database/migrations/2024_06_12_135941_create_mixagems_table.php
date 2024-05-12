<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMixagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mixagems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gravacao_id')->nullable();
            $table->dateTime('data_mixagem')->nullable();
            $table->enum('estado_mixagem', ['mixado', 'pendente'])->default('pendente');
            $table->string('duracao')->nullable();
            $table->unsignedBigInteger('responsavel')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('gravacao_id')->references('id')->on('gravacaos')->onDelete("cascade");
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
        Schema::dropIfExists('mixagems');
    }
}
