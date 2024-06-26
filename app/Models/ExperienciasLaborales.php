<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;

class ExperienciasLaborales extends Model
{
    use HasFactory;

    protected $table = 'experienciaslaborales';
    protected $primaryKey = 'idExperienciaLaboral';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCurriculum',
        'periodoInicio',
        'periodoFin',
        'funcionesDesempeñadas',
        'cargoDesempeñado',
        'nombreOrganizacion',
        'contactoOrganizacion',
        'descripcion',
    ];

    // Relación con la entidad CV
    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }
}
