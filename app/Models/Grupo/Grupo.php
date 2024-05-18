<?php

namespace App\Models\Grupo;

use App\Models\Gravacao\Estilo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $fillable = ["nome"];

    public function buscarResponsavel(){
        return $this->belongsTo(User::class, "responsavel", "id");
    }

    public function buscarEstilo(){
        return $this->belongsTo(Estilo::class, "estilo_grupo", "id");
    }
}
