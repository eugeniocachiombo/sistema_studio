<?php

namespace App\Models\Grupo;

use App\Models\Estilo\Estilo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $fillable = ["nome", "estilo_grupo", "responsavel"];

    public function buscarResponsavel(){
        return $this->belongsTo(User::class, "responsavel", "id");
    }

    public function buscarEstilo(){
        return $this->belongsTo(Estilo::class, "estilo_grupo", "id");
    }
}
