<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;

class Certificaciones extends Model
{
    use HasFactory;

    protected $table = 'certificaciones';
    protected $primaryKey = 'idCertificacion';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCurriculum',
        'tipoCertificacion',
        'nombreCertificacion',
        'codigoCertificacion',
        'institucionOtorgante',
        'fechaCertificacion',
        'descripcion',
    ];

    // Relación con la entidad CV
    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }
}
