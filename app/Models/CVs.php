<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\SolicitudAspirante;

class CVs extends Model
{
    use HasFactory;

    protected $table = 'cvs';
    protected $primaryKey = 'idCurriculum';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'numDocumento',
        'fechaPublicacion',
        'descripcion',
    ];

    protected $casts = [
        'numDocumento' => 'string'
    ];

    // Relación con la entidad Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'numDocumento', 'numDocumento');
    }

    public function solicitudesCv()
    {
        return $this->hasMany(SolicitudAspirante::class, 'idCurriculum', 'idCurriculum');
    }
}
