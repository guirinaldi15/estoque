<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected  $fillable = [
'id',
'marca',
'descricao',
'valor_unitario',
'quantidade_estoque',
'faixa_etaria_minima'
    ];
}
