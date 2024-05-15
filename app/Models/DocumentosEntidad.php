<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Telefonos;
use App\Models\Empresa;
use App\Models\Persona;

class DocumentosEntidad extends Model
{
    use HasFactory;
    protected $table = 'documentosentidad';
    protected $primaryKey = 'numDocumento';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'numDocumento',
        'tipoEntidad',
    ];

    protected $casts = [
        'numDocumento' => 'string'
    ];

    public function telefonos()
    {
        return $this->hasMany(Telefonos::class, 'numDocumento', 'numDocumento');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'numDocumento', 'numDocumento');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'numDocumento', 'numDocumento');
    }
}
