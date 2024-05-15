<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;

class RedesSociales extends Model
{
    use HasFactory;

    protected $table = 'redessociales';
    protected $primaryKey = 'numDocumento';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'numDocumento',
        'facebook',
        'linkedin',
        'whatsApp',
        'instagram',
        'twitter',
    ];

    protected $casts = [
        'numDocumento' => 'string',
        'facebook' => 'string',
        'linkedin' => 'string',
        'whatsApp' => 'string',
        'instagram' => 'string',
        'twitter' => 'string',
    ];

    // Relación con la entidad Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'numDocumento', 'numDocumento');
    }
}
