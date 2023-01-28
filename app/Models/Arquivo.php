<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arquivo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'arquivos';
    protected $fillable = [
        'nome',
        'caminho'
    ];
    
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'ativo';
}
