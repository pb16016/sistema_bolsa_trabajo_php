<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profesiones;

class Cargos extends Model
{
    use HasFactory;
    protected $table = 'cargos';
    protected $primaryKey = 'idCargo';
    protected $fillable = [
        'nombreCargo',
        'idProfesion',
        'descripcion',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function profesion()
    {
        return $this->belongsTo(Profesiones::class, 'idProfesion', 'idProfesion');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idCargo', 'idCargo');
    }
}
