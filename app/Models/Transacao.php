<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = [
        'usuario_id',
        'tipo',
        'categoria',
        'valor',
        'data',
        'forma_pagamento',
        'recorrente'
    ];
}
