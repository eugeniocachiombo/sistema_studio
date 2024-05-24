<?php

namespace App\Models\Aprovacao;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientesAprovado extends Model
{
    use HasFactory;
    protected $fillable = ["cliente"];

    public function buscarCliente(){
        return $this->belongsTo(User::class, "cliente", "id");
    }
}
