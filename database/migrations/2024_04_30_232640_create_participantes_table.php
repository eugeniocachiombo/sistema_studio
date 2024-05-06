<?php

use App\Models\Participante\Participante;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string("nome")->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete("cascade");
        
        });

        $cantor = User::find(3);
        Participante::create([
            'nome' => $cantor->name,
            'user_id' => $cantor->id
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participantes');
    }
}
