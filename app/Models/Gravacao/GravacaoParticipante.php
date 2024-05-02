<?php

namespace App\Models\Gravacao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GravacaoParticipante extends Model
{
    use HasFactory;

    protected $fillable = [
        "gravacao_id",
        "participante_id"
    ];
}
