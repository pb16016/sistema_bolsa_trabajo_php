<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EstadoCivil;

class EstadosCivilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoCivil::create(['codEstadoCivil' => 'CAS', 'EstadoCivil' => 'Casado/a']);
        EstadoCivil::create(['codEstadoCivil' => 'SOL', 'EstadoCivil' => 'Soltero/a']);
        EstadoCivil::create(['codEstadoCivil' => 'UNI', 'EstadoCivil' => 'Unión Libre']);
        EstadoCivil::create(['codEstadoCivil' => 'VIU', 'EstadoCivil' => 'Viudo/a']);
    }
}
