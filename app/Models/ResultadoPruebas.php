<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;

class ResultadoPruebas extends Model
{
    use HasFactory;

    protected $table = 'resultadopruebas';
    protected $primaryKey = 'idResultadoPrueba';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCurriculum',
        'nombrePrueba',
        'tipoPrueba',
        'resultadoObtenido',
        'fechaRealizacion',
        'urlResultadoPrueba',
        'descripcion',
    ];

    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }
}
