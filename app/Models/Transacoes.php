<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacoes extends Model
{
    protected $fillable = ['user_id', 'valor', 'cpf', 'status', 'arquivo_nome'];
}
