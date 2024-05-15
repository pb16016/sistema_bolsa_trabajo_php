<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departamentos;

class Municipios extends Model
{
    use HasFactory;

    protected $table = 'municipios';
    protected $primaryKey = 'codMunicipio';
    protected $fillable = [
        'codMunicipio', 'nombreMunicipio', 'codDepartamento'
    ];

    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'codMunicipio' => 'string'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'codDepartamento', 'codDepartamento');
    }

}
