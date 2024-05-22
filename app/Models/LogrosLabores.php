<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;

class LogrosLabores extends Model
{
    use HasFactory;

    protected $table = 'logroslabores';
    protected $primaryKey = 'idLogroLabor';
    public $timestamps = false;
    public $incrementing = true;
    
    protected $fillable = [
        'idCurriculum',
        'nombreLogroLabor',
        'tipoLogroLabor',
        'fechaRealizacion',
        'descripcion',
    ];

    // Relación con la entidad CVs
    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }
}