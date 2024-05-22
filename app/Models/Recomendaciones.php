<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;

class Recomendaciones extends Model
{
    use HasFactory;

    protected $table = 'recomendaciones';
    protected $primaryKey = 'idRecomendacion';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCurriculum',
        'tipoRecomendacion',
        'nombresRecomendador',
        'apellidosRecomendador',
        'cargoRecomendador',
        'parentescoRecomendador',
        'telefonoContacto',
        'emailContacto',
    ];

    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }
}
