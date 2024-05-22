<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CVs;

class ParticipacionEventos extends Model
{
    use HasFactory;
    protected $table = 'participacioneventos';
    protected $primaryKey = 'idEvento';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'idCurriculum',
        'nombreEvento',
        'tipoEvento',
        'lugarEvento',
        'anfitrionEvento',
        'paisEvento',
        'fechaInicio',
        'fechaFin',
        'descripcion',
    ];

    public function cv()
    {
        return $this->belongsTo(CVs::class, 'idCurriculum', 'idCurriculum');
    }
}