<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $fillable = [
        'produto_id',
        'quantidade',
        'id_cliente'
    ];
}
