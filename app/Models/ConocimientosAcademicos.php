<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;

class ConocimientosAcademicos extends Model
{
    use HasFactory;

    protected $table = 'conocimientosacademicos';
    protected $primaryKey = 'idConocimiento';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCurriculum',
        'tituloAcademico',
        'institucion',
        'fechaTitulacion',
        'fechaInicio',
        'fechaFin',
        'descripcion',
    ];

    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }
}
