<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;
use App\Models\ExperienciaRequerida;
use App\Models\OfertaTrabajo;

class PerfilPuestoTrabajo extends Model
{
    use HasFactory;

    protected $table = 'perfilpuestotrabajo';
    protected $primaryKey = 'idPerfilPuesto';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'numDocumento',
        'nombrePuesto',
        'rangoSalarial',
        'modalidadTrabajo',
        'ubicacionGeografica',
        'beneficios',
        'gradoAcademicoMinimo',
        'requisitosAdicionales',
        'idExperienciaRequerida',
    ];

    protected $casts = [
        'numDocumento' => 'string',
        'modalidadTrabajo' => 'string'
    ];

    // Relación con la entidad Empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'numDocumento', 'numDocumento');
    }

    // Relación con la entidad ExperienciaRequerida
    public function experienciasRequeridas()
    {
        return $this->hasMany(ExperienciaRequerida::class, 'idExperienciaRequerida', 'idExperienciaRequerida');
    }

    public function ofertaTrabajo()
    {
        return $this->belongsTo(OfertaTrabajo::class, 'idPerfilPuesto', 'idPerfilPuesto');
    }
}
