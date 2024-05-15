<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\Empresa;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipodocumento';
    protected $primaryKey = 'idTipoDocumento';

    protected $fillable = ['idTipoDocumento', 'tipoDocumento', 'descripcion'];
    
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'idTipoDocumento' => 'string'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idTipoDocumento', 'idTipoDocumento');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'idTipoDocumento', 'idTipoDocumento');
    }
}