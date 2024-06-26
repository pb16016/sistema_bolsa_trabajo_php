<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoDocumento;
use App\Models\Cargos;
use App\Models\EstadoCivil;
use App\Models\Direccion;
use App\Models\DocumentosEntidad;
use App\Models\RedesSociales;
use App\Models\CVs;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'persona';
    protected $primaryKey = 'numDocumento';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'numDocumento',
        'primerNombre',
        'segundoNombre',
        'primerApellido',
        'segundoApellido',
        'apellidoCasado',
        'fechaNacimiento',
        'emailPersona',
        'genero',
        'NIT',
        'NUP',
        'codEstadoCivil',
        'idTipoDocumento',
        'idCargo',
        'idDireccion',
    ];

    protected $casts = [
        'numDocumento' => 'string',
        'codEstadoCivil' => 'string',
        'idTipoDocumento' => 'string',
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'idTipoDocumento', 'idTipoDocumento');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'codEstadoCivil', 'codEstadoCivil');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargos::class, 'idCargo', 'idCargo');
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'idDireccion', 'idDireccion');
    }

    public function documentoEntidad()
    {
        return $this->belongsTo(DocumentosEntidad::class, 'numDocumento', 'numDocumento');
    }

    public function redesSociales()
    {
        return $this->belongsTo(RedesSociales::class, 'numDocumento', 'numDocumento');
    }

    public function CVs()
    {
        return $this->hasMany(CVs::class, 'numDocumento', 'numDocumento');
    }
}
