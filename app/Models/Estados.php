<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SolicitudAspirante;

class Estados extends Model
{
    use HasFactory;
    protected $table = 'estados';
    protected $primaryKey = 'idEstado';

    protected $fillable = [
        'nombreEstado',
        'descripcion',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function solicitudesAspirante()
    {
        return $this->hasMany(SolicitudAspirante::class, 'idEstado', 'idEstadoSolicitud');
    }
}
