<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paises;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Paises::create(['nombrePais' => 'Argentina', 'abreviaturaPais' => 'ARG']);
        Paises::create(['nombrePais' => 'Bolivia', 'abreviaturaPais' => 'BOL']);
        Paises::create(['nombrePais' => 'Brasil', 'abreviaturaPais' => 'BRA']);
        Paises::create(['nombrePais' => 'Chile', 'abreviaturaPais' => 'CHL']);
        Paises::create(['nombrePais' => 'Colombia', 'abreviaturaPais' => 'COL']);
        Paises::create(['nombrePais' => 'Costa Rica', 'abreviaturaPais' => 'CRI']);
        Paises::create(['nombrePais' => 'Cuba', 'abreviaturaPais' => 'CUB']);
        Paises::create(['nombrePais' => 'Ecuador', 'abreviaturaPais' => 'ECU']);
        Paises::create(['nombrePais' => 'El Salvador', 'abreviaturaPais' => 'SLV']);
        Paises::create(['nombrePais' => 'Guatemala', 'abreviaturaPais' => 'GTM']);
        Paises::create(['nombrePais' => 'Honduras', 'abreviaturaPais' => 'HND']);
        Paises::create(['nombrePais' => 'Nicaragua', 'abreviaturaPais' => 'NIC']);
        Paises::create(['nombrePais' => 'Costa Rica', 'abreviaturaPais' => 'CRC']);
        Paises::create(['nombrePais' => 'Panamá', 'abreviaturaPais' => 'PAN']);
        Paises::create(['nombrePais' => 'Paraguay', 'abreviaturaPais' => 'PRY']);
        Paises::create(['nombrePais' => 'Perú', 'abreviaturaPais' => 'PER']);
        Paises::create(['nombrePais' => 'Puerto Rico', 'abreviaturaPais' => 'PRI']);
        Paises::create(['nombrePais' => 'República Dominicana', 'abreviaturaPais' => 'DOM']);
        Paises::create(['nombrePais' => 'Uruguay', 'abreviaturaPais' => 'URY']);
        Paises::create(['nombrePais' => 'Venezuela', 'abreviaturaPais' => 'VEN']);
        Paises::create(['nombrePais' => 'Estados Unidos', 'abreviaturaPais' => 'USA']);
        Paises::create(['nombrePais' => 'Canadá', 'abreviaturaPais' => 'CAN']);
        Paises::create(['nombrePais' => 'México', 'abreviaturaPais' => 'MEX']);

        Paises::create(['nombrePais' => 'España', 'abreviaturaPais' => 'ESP']);
        Paises::create(['nombrePais' => 'Portugal', 'abreviaturaPais' => 'POR']);
        Paises::create(['nombrePais' => 'Francia', 'abreviaturaPais' => 'FRA']);
        Paises::create(['nombrePais' => 'Alemania', 'abreviaturaPais' => 'GER']);
        Paises::create(['nombrePais' => 'Italia', 'abreviaturaPais' => 'ITA']);
        Paises::create(['nombrePais' => 'Reino Unido', 'abreviaturaPais' => 'UK']);

    }
}
