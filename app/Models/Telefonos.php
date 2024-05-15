<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoTelefono;
use App\Models\Paises;
use App\Models\DocumentosEntidad;

class Telefonos extends Model
{
    use HasFactory;
    protected $table = 'telefonos';
    protected $primaryKey = 'numTelefono';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'numTelefono',
        'numDocumento',
        'idTipoTelefono',
        'idPais',
        'descripcion',
    ];

    protected $casts = [
        'numTelefono' => 'string',
        'numDocumento' => 'string'
    ];

    // Relación con la entidad TipoTelefono
    public function tipoTelefono()
    {
        return $this->belongsTo(TipoTelefono::class, 'idTipoTelefono', 'idTipoTelefono');
    }

    // Relación con la entidad Pais
    public function pais()
    {
        return $this->belongsTo(Paises::class, 'idPais', 'idPais');
    }

    // Relación polimórfica con la entidad Persona o empresa
    public function entidad()
    {
        return $this->belongsTo(DocumentosEntidad::class, 'numDocumento', 'numDocumento');
    }
}
