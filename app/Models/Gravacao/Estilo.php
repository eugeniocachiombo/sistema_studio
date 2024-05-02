<?php

namespace App\Models\Gravacao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estilo extends Model
{
    use HasFactory;

    protected $fillable = ["tipo"];
}
