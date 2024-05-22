<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;
use App\Models\CategoriaNivel;

class HabilidadesIdiomas extends Model
{
    use HasFactory;

    protected $table = 'habilidadesidiomas';
    protected $primaryKey = 'idHabilidadIdioma';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCurriculum',
        'idioma',
        'nivelEscritura',
        'nivelLectura',
        'nivelConversacion',
        'nivelEscucha',
        'idCategoriaNivel',
    ];

    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }

    public function categoriaNivel()
    {
        return $this->belongsTo(CategoriaNivel::class, 'idCategoriaNivel', 'idCategoriaNivel');
    }
}