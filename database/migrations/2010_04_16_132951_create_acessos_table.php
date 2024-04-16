<?php

use App\Models\Acesso\Acesso;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acessos', function (Blueprint $table) {
            $table->id();
            $table->string("tipo");
            $table->timestamps();
        });

        Acesso::create(["tipo" => "produtor"]);
        Acesso::create(["tipo" => "atendente"]);
        Acesso::create(["tipo" => "cliente"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acessos');
    }
}
