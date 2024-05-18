<?php

namespace App\Models\RecuperarConta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoConfirmacao extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id", "codigo" 
    ];
}
