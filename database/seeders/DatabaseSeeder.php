<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\EstadosCivilesSeeder;
use Database\Seeders\TipoDocumentosSeeder;
use Database\Seeders\PaisesSeeder;
use Database\Seeders\DepartamentosSeeder;
use Database\Seeders\MunicipiosSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(EstadosCivilesSeeder::class);
        $this->call(TipoDocumentosSeeder::class);
        $this->call(PaisesSeeder::class); 
        $this->call(DepartamentosSeeder::class);*/
        $this->call(MunicipiosSeeder::class);
    }
}
