<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGravacaoParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gravacao_participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gravacao_id')->nullable();
            $table->unsignedBigInteger('participante_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('gravacao_id')->references('id')->on('gravacaos')->onDelete("cascade");
            $table->foreign('participante_id')->references('id')->on('participantes')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gravacao_participantes');
    }
}
