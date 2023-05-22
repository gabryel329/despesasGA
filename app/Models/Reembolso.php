<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reembolso extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor',
        'data',
        'gasto_id',
        'observacao',
        'centrocusto_id',
        'usuario_id',
        'forma_pgt',
        'parcelas',
        'image',
        'corporativo',
        'status',
        'tipo',
        'movimento'
    ];
}
