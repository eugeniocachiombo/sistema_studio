<?php

namespace App\Models\Utilizador;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        "nome",
        "sobrenome",
        "genero",
        "nascimento",
        "user_id",
        "nacionalidade",
        "provincia",
        "municipio",
        "endereco",
        "twiter",
        "facebook",
        "instagram ",
        "linkedin "
    ];
}
