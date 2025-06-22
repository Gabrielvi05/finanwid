<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadastro extends Model
{
    protected $table = 'cadastro';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'senha',
    ];

    public $timestamps = false;

    protected $hidden = [
        'senha',
    ];
}
