<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEntidadUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipoentidadusuario')->insert([
            [
                'tipoEntidad' => 'Candidato',
                'descripcion' => 'Persona que busca empleo a través de la bolsa de trabajo.'
            ],
            [
                'tipoEntidad' => 'Reclutador',
                'descripcion' => 'Persona o empresa que busca candidatos para cubrir vacantes.'
            ],
            [
                'tipoEntidad' => 'Empresa',
                'descripcion' => 'Organización que publica ofertas de trabajo y contrata candidatos.'
            ],
            [
                'tipoEntidad' => 'Agencia de Empleo',
                'descripcion' => 'Entidad que actúa como intermediaria entre candidatos y empresas.'
            ],
            [
                'tipoEntidad' => 'Administrativo',
                'descripcion' => 'Persona o entidad que ofrece servicios de administración en el sistema.'
            ],
            [
                'tipoEntidad' => 'Operador',
                'descripcion' => 'Persona o entidad que ofrece soporte tecnico en el sistema.'
            ]
        ]);
    }
}
