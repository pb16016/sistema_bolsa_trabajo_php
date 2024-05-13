<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departamentos;
use App\Models\Empresa;

class Paises extends Model
{
    use HasFactory;

    protected $table = 'paises';
    protected $primaryKey = 'idPais';
    protected $fillable = ['nombrePais', 'abreviaturaPais'];

    public $timestamps = false;
    public $incrementing = true;

    public function departamentos()
    {
        return $this->hasMany(Departamentos::class, 'idPais', 'idPais');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'idTipoDocumento', 'idTipoDocumento');
    }
}
