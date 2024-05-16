<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estados;
use App\Models\PerfilPuestoTrabajo;
use App\Models\SolicitudAspirante;

class OfertaTrabajo extends Model
{
    use HasFactory;

    protected $table = 'ofertatrabajo';
    protected $primaryKey = 'idOfertaLaboral';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idEstadoOferta',
        'idPerfilPuesto',
        'fechaPublicacion',
        'fechaCierre',
        'descripcion',
    ];

    // Relación con la entidad Estados
    public function estadoOferta()
    {
        return $this->belongsTo(Estados::class, 'idEstadoOferta', 'idEstado');
    }

    // Relación con la entidad PerfilPuestoTrabajo
    public function perfilPuesto()
    {
        return $this->belongsTo(PerfilPuestoTrabajo::class, 'idPerfilPuesto', 'idPerfilPuesto');
    }

    public function solicitudesAspirante()
    {
        return $this->hasMany(SolicitudAspirante::class, 'idOfertaLaboral', 'idOfertaLaboral');
    }
}
