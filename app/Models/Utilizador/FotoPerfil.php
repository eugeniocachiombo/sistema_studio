<?php

namespace App\Models\Utilizador;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoPerfil extends Model
{
    use HasFactory;

    protected $fillable =[
        "caminho_arquivo",
        "tipo_arquivo",
        "nome_arquivo",
        "extensao_arquivo",
        "user_id"
    ];

    public function buscarFotoPerfil(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
