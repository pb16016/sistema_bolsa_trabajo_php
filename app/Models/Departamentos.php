<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paises;

class Departamentos extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $primaryKey = 'codDepartamento';
    protected $fillable = [
        'codDepartamento', 'nombreDepartamento', 'idPais'
    ];

    public $timestamps = false;

    protected $casts = [
        'codDepartamento' => 'string',
    ];

    public function pais()
    {
        return $this->belongsTo(Paises::class, 'idPais', 'idPais');
    }
}
