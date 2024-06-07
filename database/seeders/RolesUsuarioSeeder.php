<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesUsuarioSeeder extends Seeder
{
    public function run()
    {
        // Define los roles que deseas insertar
        $roles = [
            [
                'nombreRol' => 'admin',
                'descripcionRol' => 'Administrador',
            ],
            [
                'nombreRol' => 'aspirante',
                'descripcionRol' => 'Role de Aspirante',
            ],
            [
                'nombreRol' => 'empresa',
                'descripcionRol' => 'Role de empresa',
            ],
            [
                'nombreRol' => 'viewer',
                'descripcionRol' => 'Role externo',
            ],
        ];

        // Insertar los roles en la tabla de rolesusuario
        DB::table('rolesusuario')->insert($roles);
    }
}
