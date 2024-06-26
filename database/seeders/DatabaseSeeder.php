<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TruncateTablesSeeder

;
use Database\Seeders\EstadosCivilesSeeder;
use Database\Seeders\TipoDocumentosSeeder;
use Database\Seeders\PaisesSeeder;
use Database\Seeders\DepartamentosSeeder;
use Database\Seeders\MunicipiosSeeder;
use Database\Seeders\CargosSeeder;
use Database\Seeders\ProfesionesSeeder;
use Database\Seeders\CategoriasNivelesSeeder;
use Database\Seeders\TipoTelefonoSeeder;
use Database\Seeders\TipoEntidadUsuarioSeeder;
use Database\Seeders\EstadosSeeder;
use Database\Seeders\EstadoUsuarioSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\RolesUsuarioSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        //$this->call(TruncateTablesSeeder::class);
        $this->call(EstadosCivilesSeeder::class);
        $this->call(TipoDocumentosSeeder::class);

        $this->call(PaisesSeeder::class);
        $this->call(DepartamentosSeeder::class);
        $this->call(MunicipiosSeeder::class);

        $this->call(ProfesionesSeeder::class);
        $this->call(CargosSeeder::class);
        
        $this->call(CategoriasNivelesSeeder::class);
        $this->call(TipoTelefonoSeeder::class);
        $this->call(TipoEntidadUsuarioSeeder::class);
        $this->call(EstadosSeeder::class);
        $this->call(EstadoUsuarioSeeder::class);

        $this->call(RolesUsuarioSeeder::class);
        $this->call(RolesSeeder::class);
        User::factory()->create([
            'username' => 'TestUser',
            'email' => 'pb16016@ues.edu.sv',
            'state_user_id' => 1,
            'failed_attempts' => 0,
        ]);
    }
}
