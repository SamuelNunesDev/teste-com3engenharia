<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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
    const DELETED_AT = 'excluido_em';

    /**
     * Filtra arquivos por dia.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Carbon\Carbon $data
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeDoDia($query, $data)
    {
        return $query->whereDate('criado_em', $data);
    }
    
    /**
     * Retorna a url publica do arquivo.
     * 
     * @return string
     */
    public function getUrlPublicaAttribute()
    {
        return url(Storage::url($this->caminho));
    }

    /**
     * Filtra arquivos por mês e ano.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Carbon\Carbon $data
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePorMesAno($query, $data)
    {
        return $query->whereYear('criado_em', $data->format('Y'))->whereMonth('criado_em', $data->format('m'));
    }
}
