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
        "nacionalidade",
        "provincia",
        "municipio",
        "endereco"
    ];
}
