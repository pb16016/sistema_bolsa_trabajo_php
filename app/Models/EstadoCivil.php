<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;

class EstadoCivil extends Model
{
    use HasFactory;
    protected $table = 'estadoscivil';
    protected $primaryKey = 'codEstadoCivil';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        'codEstadoCivil',
        'EstadoCivil',
    ];

    protected $casts = [
        'codEstadoCivil' => 'string'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'codEstadoCivil', 'codEstadoCivil');
    }
}
