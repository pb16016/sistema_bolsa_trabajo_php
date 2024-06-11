<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\SolicitudAspirante;

class CVs extends Model
{
    use HasFactory;

    protected $table = 'cvs';
    protected $primaryKey = 'idCurriculum';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'numDocumento',
        'fechaPublicacion',
        'descripcion',
    ];

    protected $casts = [
        'numDocumento' => 'string'
    ];

    // Relación con la entidad Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'numDocumento', 'numDocumento');
    }

    public function solicitudesCv()
    {
        return $this->hasMany(SolicitudAspirante::class, 'idCurriculum', 'idCurriculum');
    }

    public function experienciasLaborales()
    {
        return $this->hasMany(ExperienciasLaborales::class, 'idCurriculum', 'idCurriculum');
    }
    public function certificaciones()
    {
        return $this->hasMany(Certificaciones::class, 'idCurriculum', 'idCurriculum');
    }

    public function conocimientosAcademicos()
    {
        return $this->hasMany(ConocimientosAcademicos::class, 'idCurriculum', 'idCurriculum');
    }

    public function habilidadesTecnicas()
    {
        return $this->hasMany(HabilidadesTecnicas::class, 'idCurriculum', 'idCurriculum');
    }

    public function habilidadesIdiomas()
    {
        return $this->hasMany(HabilidadesIdiomas::class, 'idCurriculum', 'idCurriculum');
    }

    public function recomendaciones()
    {
        return $this->hasMany(Recomendaciones::class, 'idCurriculum', 'idCurriculum');
    }
    
    public function logrosLabores()
    {
        return $this->hasMany(LogrosLabores::class, 'idCurriculum', 'idCurriculum');
    }

    public function resultadosPruebas()
    {
        return $this->hasMany(ResultadoPruebas::class, 'idCurriculum', 'idCurriculum');
    }

    public function participacionEventos()
    {
        return $this->hasMany(ParticipacionEventos::class, 'idCurriculum', 'idCurriculum');
    }

    public function articulosLibros()
    {
        return $this->hasMany(ArticulosLibros::class, 'idCurriculum', 'idCurriculum');
    }


}
