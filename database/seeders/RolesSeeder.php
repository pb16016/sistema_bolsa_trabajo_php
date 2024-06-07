<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Define los roles que deseas insertar
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'Administrador',
            ],
            [
                'name' => 'aspirante',
                'guard_name' => 'Role de Aspirante',
            ],
            [
                'name' => 'empresa',
                'guard_name' => 'Role de empresa',
            ],
            [
                'name' => 'viewer',
                'guard_name' => 'Role externo',
            ],
        ];

        // Insertar los roles en la tabla de roles
        DB::table('roles')->insert($roles);
    }
}
