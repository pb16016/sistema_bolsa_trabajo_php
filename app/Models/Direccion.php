<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipio;
use App\Models\Persona;
use App\Models\Empresa;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direccion';
    protected $primaryKey = 'idDireccion';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'direccion',
        'detalleDireccion',
        'codMunicipio'
    ];

    // Relación con la entidad Municipio
    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'codMunicipio', 'codMunicipio');
    }

    public function persona()
    {
        return $this->belongsTo(Direccion::class, 'idDireccion', 'idDireccion');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'idTipoDocumento', 'idTipoDocumento');
    }
}
