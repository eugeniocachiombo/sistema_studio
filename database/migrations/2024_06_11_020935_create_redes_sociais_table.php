<?php

use App\Models\Utilizador\RedesSociais;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedesSociaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redes_sociais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('twitter')->nullable()->default("https://twitter.com/#");
            $table->string('facebook')->nullable()->default("https://facebook.com/#");
            $table->string('instagram')->nullable()->default("https://instagram.com/#");
            $table->string('linkedin')->nullable()->default("https://linkedin.com/#");
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->timestamps();
            $table->softDeletes();
        });

        RedesSociais::create(["user_id" => 1]);
        RedesSociais::create(["user_id" => 2]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redes_sociais');
    }
}
