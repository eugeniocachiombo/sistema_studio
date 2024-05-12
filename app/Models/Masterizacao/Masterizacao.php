<?php

namespace App\Models\Masterizacao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterizacao extends Model
{
    use HasFactory;
    protected $fillable = [
        "mixagem_id",
        "data_master",
        "estado_master",
        "duracao",
        "responsavel"
    ];
}
