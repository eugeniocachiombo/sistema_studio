<?php

namespace App\Models\Utilizador;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroActividade extends Model
{
    use HasFactory;

    protected $fillable = [
        "mensagem",
        "tipo_msg",
        "user_id",
    ];
}
