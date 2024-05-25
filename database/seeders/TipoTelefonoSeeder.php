<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoTelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipotelefono')->insert([
            [
                'tipoTelefono' => 'Móvil'
            ],
            [
                'tipoTelefono' => 'Casa'
            ],
            [
                'tipoTelefono' => 'Trabajo'
            ],
            [
                'tipoTelefono' => 'Fax'
            ],
            [
                'tipoTelefono' => 'Otro'
            ],
        ]);
    }
}
