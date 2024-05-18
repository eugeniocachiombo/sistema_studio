<?php

use App\Models\Estilo\Estilo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstilosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estilos', function (Blueprint $table) {
            $table->id();
            $table->string("tipo");
            $table->string("preco")->nullable();
            $table->unsignedBigInteger('responsavel')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('responsavel')->references('id')->on('users')->onDelete("cascade");
        });

        Estilo::create(["tipo" => "Kizomba"]);
        Estilo::create(["tipo" => "Semba"]);
        Estilo::create(["tipo" => "Kuduro"]);
        Estilo::create(["tipo" => "African Vibers"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estilos');
    }
}
