<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEntidadUsuario extends Model
{
    use HasFactory;
    protected $table = 'tipoentidadusuario';
    protected $primaryKey = 'idTipoEntidad';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'tipoEntidad',
        'descripcion'
    ];
}
