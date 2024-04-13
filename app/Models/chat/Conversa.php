<?php

namespace App\Models\chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversa extends Model
{
    use HasFactory;
    
    protected $table = "conversas";
    protected $fillable =[
        "emissor",
        "receptor",
        "estado",
        "mensagem",
        "caminho_arquivo",
        "tipo_arquivo",
        "nome_arquivo",
        "extensao_arquivo",
    ];
}
