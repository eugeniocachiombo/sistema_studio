<?php

namespace App\Models\Estilo;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estilo extends Model
{
    use HasFactory;

    protected $fillable = ["tipo", "preco", "responsavel"];

    public function buscarResponsavel(){
        return $this->belongsTo(User::class, "responsavel", "id");
    }

}
