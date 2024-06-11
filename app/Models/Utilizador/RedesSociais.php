<?php

namespace App\Models\Utilizador;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedesSociais extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "twitter",
        "facebook",
        "instagram",
        "linkedin"
    ];
}
