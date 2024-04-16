<?php

namespace App\Models\Acesso;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    use HasFactory;
    protected $fillable = ["tipo"];
}
