<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estadousuario')->insert([
            [
                'estadoUsuario' => 'Activo',
                'descripcion' => 'El usuario está activo y puede acceder al sistema.'
            ],
            [
                'estadoUsuario' => 'Inactivo',
                'descripcion' => 'El usuario está inactivo y no puede acceder al sistema.'
            ],
            [
                'estadoUsuario' => 'Bloqueado',
                'descripcion' => 'El usuario ha sido bloqueado temporalmente.'
            ],
            [
                'estadoUsuario' => 'Suspendido',
                'descripcion' => 'El usuario ha sido suspendido temporalmente.'
            ],
            [
                'estadoUsuario' => 'Pendiente',
                'descripcion' => 'El usuario está pendiente de activación.'
            ],
            [
                'estadoUsuario' => 'Eliminado',
                'descripcion' => 'El usuario ha sido eliminado del sistema.'
            ],
        ]);
    }
}
