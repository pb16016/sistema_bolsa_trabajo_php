<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Telefonos;

class TipoTelefono extends Model
{
    use HasFactory;
    protected $table = 'tipotelefono';
    protected $primaryKey = 'idTipoTelefono';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'tipoTelefono',
    ];

    public function telefonos()
    {
        return $this->hasMany(Telefonos::class, 'idTipoTelefono', 'idTipoTelefono');
    }
}
