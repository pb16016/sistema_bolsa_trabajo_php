<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruncateTablesSeeder extends Seeder
{
    public function run()
    {
        // Truncar las tablas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('estadoscivil')->truncate();
        DB::table('tipodocumento')->truncate();
        DB::table('paises')->truncate();
        DB::table('departamentos')->truncate();
        DB::table('municipios')->truncate();

        DB::table('cargos')->truncate();
        DB::table('profesiones')->truncate();
        DB::table('categorianivel')->truncate();
        DB::table('tipotelefono')->truncate();
        DB::table('tipoentidadusuario')->truncate();
        DB::table('estados')->truncate();
        DB::table('estadousuario')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}