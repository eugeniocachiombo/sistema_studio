<?php

namespace App\Models\Mixagem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mixagem extends Model
{
    use HasFactory;
    protected $fillable = [
        "gravacao_id",
        "data_mixagem",
        "estado_mixagem",
        "duracao",
        "responsavel"
    ];
}
