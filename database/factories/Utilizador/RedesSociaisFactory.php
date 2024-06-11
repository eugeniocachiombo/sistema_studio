<?php

namespace Database\Factories\Utilizador;

use App\Models\User;
use App\Models\Utilizador\RedesSociais;
use Illuminate\Database\Eloquent\Factories\Factory;

class RedesSociaisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all();
        foreach ($user as $item) {
            if(!RedesSociais::where("user_id", $item->id)->first()){
                RedesSociais::create(["user_id" => $item->id]);
            }
        }
        return [
            //
        ];
    }
}
