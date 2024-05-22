<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;

class ArticulosLibros extends Model
{
    use HasFactory;

    protected $table = 'articuloslibros';
    protected $primaryKey = 'idArticuloLibro';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCurriculum',
        'tituloPublicacion',
        'lugarPublicacion',
        'tipoPublicacion',
        'fechaPublicacion',
        'edicion',
        'ISBN',
        'descripcion',
    ];

    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }
}