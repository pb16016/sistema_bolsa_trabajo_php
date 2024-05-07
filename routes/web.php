<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\EstadoCivilController;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\MunicipiosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tipo_documento', [TipoDocumentoController::class, 'getAll'])->name('tipo_documento');

Route::get('/estadocivil', [EstadoCivilController::class, 'getAll'])->name('estadocivil');

Route::get('/paises', [PaisesController::class, 'getAll'])->name('paises');

Route::get('/paises/departamentos', [DepartamentosController::class, 'getAll'])->name('departamentos');

Route::get('/paises/departamentos/municipios', [MunicipiosController::class, 'getAll'])->name('municipios');