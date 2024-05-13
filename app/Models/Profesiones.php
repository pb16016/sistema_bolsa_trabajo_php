<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cargos;
use App\Models\Persona;

class Profesiones extends Model
{
    use HasFactory;
    protected $table = 'profesiones';
    protected $primaryKey = 'idProfesion';
    protected $fillable = [
        'nombreProfesion',
        'idCargo',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function cargo()
    {
        return $this->belongsTo(Cargos::class, 'idCargo', 'idCargo');
    }
    
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idProfesion', 'idProfesion');
    }
}
