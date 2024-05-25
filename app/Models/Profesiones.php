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
        'descripcion',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function cargos()
    {
        return $this->hasMany(Cargos::class, 'idProfesion', 'idProfesion');
    }
    
}
