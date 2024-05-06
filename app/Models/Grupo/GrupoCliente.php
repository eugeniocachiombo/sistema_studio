<?php

namespace App\Models\Grupo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoCliente extends Model
{
    use HasFactory;
    protected $fillable = [
        "grupo_id", "membro" 
    ];
}
