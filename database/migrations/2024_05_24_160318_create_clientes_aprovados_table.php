<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesAprovadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_aprovados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cliente')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes_aprovados');
    }
}
