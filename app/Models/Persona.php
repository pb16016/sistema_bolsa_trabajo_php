<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoDocumento;
use App\Models\Profesiones;
use App\Models\EstadoCivil;
use App\Models\Direccion;

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
        'idProfesion',
        'idDireccion',
    ];

    protected $casts = [
        'numDocumento' => 'string',
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'idTipoDocumento', 'idTipoDocumento');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'codEstadoCivil', 'codEstadoCivil');
    }

    public function profesion()
    {
        return $this->belongsTo(Profesiones::class, 'idProfesion', 'idProfesion');
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'idDireccion', 'idDireccion');
    }
}
