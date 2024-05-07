<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipoDocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoDocumento::create(['idTipoDocumento' => 'DUI', 'tipoDocumento' => 'DUI', 'descripcion' => 'Documento Único de Identidad']);
        TipoDocumento::create(['idTipoDocumento' => 'PAS', 'tipoDocumento' => 'Pasaporte', 'descripcion' => 'Pasaporte para personas Extranjeras']);
        TipoDocumento::create(['idTipoDocumento' => 'NIT', 'tipoDocumento' => 'NIT', 'descripcion' => 'Número de Identidad Tributario']);
    }
}
