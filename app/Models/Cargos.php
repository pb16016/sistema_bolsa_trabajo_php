<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    use HasFactory;
    protected $table = 'cargos';
    protected $primaryKey = 'idCargo';
    protected $fillable = [
        'nombreCargo',
        'descripcion',
    ];

    public $timestamps = false;
    public $incrementing = true;

    public function profesiones()
    {
        return $this->hasMany(Profesiones::class, 'idCargo', 'idCargo');
    }
}
