<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = strtoupper($value);
    }

    use HasFactory;
    protected $fillable = [
        'nome',
        'tipo',
        'centrocusto_id',
        'observacao'
    ];
}
