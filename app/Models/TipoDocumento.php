<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipodocumento';
    protected $primaryKey = 'idTipoDocumento';

    protected $fillable = ['idTipoDocumento', 'tipoDocumento', 'descripcion'];
    
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'idTipoDocumento' => 'string',
    ];
}