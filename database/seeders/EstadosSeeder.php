<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([
            [
                'nombreEstado' => 'Activo',
                'descripcion' => 'Estado activo para el registro.'
            ],
            [
                'nombreEstado' => 'Inactivo',
                'descripcion' => 'Estado inactivo para el registro.'
            ],
            [
                'nombreEstado' => 'Pendiente',
                'descripcion' => 'Estado pendiente de revisión para el registro.'
            ],
            [
                'nombreEstado' => 'Aprobado',
                'descripcion' => 'Estado aprobado para el registro.'
            ],
            [
                'nombreEstado' => 'Rechazado',
                'descripcion' => 'Estado rechazado para el registro.'
            ],
            [
                'nombreEstado' => 'Suspendido',
                'descripcion' => 'Estado suspendido para el registro.'
            ],
            [
                'nombreEstado' => 'Finalizado',
                'descripcion' => 'Estado finalizado para el registro.'
            ],
            [
                'nombreEstado' => 'Solicitado',
                'descripcion' => 'Estado solicitado para el registro.'
            ],
            [
                'nombreEstado' => 'Contratado',
                'descripcion' => 'El candidato ha sido contratado.'
            ],
            [
                'nombreEstado' => 'Cerrado',
                'descripcion' => 'El estado es cerrado para el proceso.'
            ]
        ]);
    }
}
