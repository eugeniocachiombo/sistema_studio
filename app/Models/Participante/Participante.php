<?php

namespace App\Models\Participante;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;
    protected $fillable = ["nome", "user_id", "grupo_id"];
}
