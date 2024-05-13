<?php

namespace App\Models\Gravacao;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gravacao extends Model
{
    use HasFactory;

    protected $fillable = [
        "cliente_id",
        "grupo_id",
        "titulo_audio",
        "estilo_audio",
        "data_gravacao",
        "estado_gravacao",
        "duracao",
        "responsavel"
    ];

    public function buscarCliente(){
        return $this->belongsTo(User::class, "cliente_id", "id");
    }
}
