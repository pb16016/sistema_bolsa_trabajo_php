<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departamentos;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Departamentos::create(['codDepartamento' => '01', 'nombreDepartamento' => 'Ahuachapán', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '02', 'nombreDepartamento' => 'Cabañas', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '03', 'nombreDepartamento' => 'Chalatenango', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '04', 'nombreDepartamento' => 'Cuscatlán', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '05', 'nombreDepartamento' => 'La Libertad', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '06', 'nombreDepartamento' => 'La Paz', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '07', 'nombreDepartamento' => 'La Unión', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '08', 'nombreDepartamento' => 'Morazán', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '09', 'nombreDepartamento' => 'San Miguel', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '10', 'nombreDepartamento' => 'San Salvador', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '11', 'nombreDepartamento' => 'San Vicente', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '12', 'nombreDepartamento' => 'Santa Ana', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '13', 'nombreDepartamento' => 'Sonsonate', 'idPais' => 9]);
        Departamentos::create(['codDepartamento' => '14', 'nombreDepartamento' => 'Usulután', 'idPais' => 9]);
    }
}
