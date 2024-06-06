<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesUsuario extends Model
{
    use HasFactory;

    protected $table = 'rolesusuario';
    protected $primaryKey = 'idRol';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'nombreRol',
        'descripcionRol',
    ];

}
