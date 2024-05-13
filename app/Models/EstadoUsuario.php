<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoUsuario extends Model
{
    use HasFactory;

    protected $table = 'estadousuario';
    protected $primaryKey = 'idEstadoUsuario';

    protected $fillable = [
        'estadoUsuario',
        'descripcion',
    ];

    public $timestamps = false;
    public $incrementing = true;
}
