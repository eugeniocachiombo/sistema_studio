<?php

namespace App\Models\Aprovacao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientesAprovado extends Model
{
    use HasFactory;
    protected $fillable = ["cliente"];
}
