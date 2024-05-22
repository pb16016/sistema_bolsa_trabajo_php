<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;

class HabilidadesTecnicas extends Model
{
    use HasFactory;

    protected $table = 'habilidadestecnicas';
    protected $primaryKey = 'idHabilidadTecnica';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCurriculum',
        'nombreHabilidad',
        'tipoHabilidad',
        'descripcion',
    ];

    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }
}
