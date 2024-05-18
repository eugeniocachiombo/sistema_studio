<?php

use App\Models\Grupo\Grupo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string("nome")->nullable();
            $table->unsignedBigInteger('estilo_grupo')->nullable();
            $table->unsignedBigInteger('responsavel')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('estilo_grupo')->references('id')->on('estilos')->onDelete("cascade");
            $table->foreign('responsavel')->references('id')->on('users')->onDelete("cascade");
        });
    }

    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
