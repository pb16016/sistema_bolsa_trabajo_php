<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasNivelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorianivel')->insert([
            [
                'categoriaNivel' => 'Básico',
                'descripcion' => 'Conocimiento básico del idioma, capacidad limitada para comunicarse.'
            ],
            [
                'categoriaNivel' => 'Intermedio',
                'descripcion' => 'Capacidad moderada para leer, escribir, escuchar y hablar en el idioma.'
            ],
            [
                'categoriaNivel' => 'Avanzado',
                'descripcion' => 'Alta competencia en el idioma, capacidad para comunicarse de manera efectiva en situaciones complejas.'
            ],
            [
                'categoriaNivel' => 'Fluido',
                'descripcion' => 'Capacidad para comunicarse casi como un hablante nativo, con pocas o ninguna limitación.'
            ],
            [
                'categoriaNivel' => 'Nativo',
                'descripcion' => 'Habla el idioma como un nativo, sin ninguna limitación.'
            ],
        ]);
    }
}
