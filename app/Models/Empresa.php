<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoDocumento;
use App\Models\Direccion;
use App\Models\Paises;
use App\Models\DocumentosEntidad;
use App\Models\PerfilPuestoTrabajo;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';
    protected $primaryKey = 'numDocumento';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'numDocumento',
        'nombreComercialEmpresa',
        'nombreLegalEmpresa',
        'rubro',
        'emailEmpresa',
        'sitioWeb',
        'idPais',
        'idDireccion',
        'idTipoDocumento',
        'descripcion',
    ];

    protected $casts = [
        'numDocumento' => 'string'
    ];

    // Relación con la entidad Pais
    public function pais()
    {
        return $this->belongsTo(Paises::class, 'idPais', 'idPais');
    }

    // Relación con la entidad Direccion
    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'idDireccion', 'idDireccion');
    }

    // Relación con la entidad TipoDocumento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'idTipoDocumento', 'idTipoDocumento');
    }

    public function documentoEntidad()
    {
        return $this->belongsTo(DocumentosEntidad::class, 'numDocumento', 'numDocumento');
    }

    public function perfilesPuestoTrabajo()
    {
        return $this->hasMany(PerfilPuestoTrabajo::class, 'numDocumento', 'numDocumento');
    }
}
