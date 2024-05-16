<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cargos;
use App\Models\PerfilPuestoTrabajo;

class ExperienciaRequerida extends Model
{
    use HasFactory;

    protected $table = 'experienciarequerida';
    protected $primaryKey = 'idExperienciaRequerida';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCargo',
        'conocimientosRequeridos',
        'habilidadesRequeridas',
        'tiempoMinimoCargo',
        'descripcion',
    ];

    // Relación con la entidad Cargo
    public function cargo()
    {
        return $this->belongsTo(Cargos::class, 'idCargo', 'idCargo');
    }

    public function perfilPuestoTrabajo()
    {
        return $this->belongsTo(PerfilPuestoTrabajo::class, 'idExperienciaRequerida', 'idExperienciaRequerida');
    }
}
