<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;
use App\Models\OfertaTrabajo;
use App\Models\Estados;

class SolicitudAspirante extends Model
{
    use HasFactory;

    protected $table = 'solicitudaspirante';
    protected $primaryKey = 'idCurriculum';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'idCurriculum',
        'idOfertaLaboral',
        'idEstadoSolicitud',
        'fechaSolicitud',
        'descripcion',
    ];

    // Relación con la entidad CV
    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }

    // Relación con la entidad OfertaTrabajo
    public function ofertaTrabajo()
    {
        return $this->belongsTo(OfertaTrabajo::class, 'idOfertaLaboral', 'idOfertaLaboral');
    }

    // Relación con la entidad Estados
    public function estadoSolicitud()
    {
        return $this->belongsTo(Estados::class, 'idEstadoSolicitud', 'idEstado');
    }
}
