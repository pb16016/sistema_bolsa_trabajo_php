<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\EstadoUsuarioController;
use App\Http\Controllers\EstadoCivilController;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\ProfesionesController;
use App\Http\Controllers\TipoTelefonoController;
use App\Http\Controllers\TipoEntidadUsuarioController;
use App\Http\Controllers\EstadosController;
use App\Http\Controllers\CategoriaNivelController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\EmpresaController;


//Views locales

Route::get('/', function () {
    return view('welcome');
});

#Route::get('/tipo_documento', [TipoDocumentoController::class, 'getAll'])->name('tipo_documento');

#Route::get('/estadocivil', [EstadoCivilController::class, 'getAll'])->name('estadocivil');

#Route::get('/paises', [PaisesController::class, 'getAll'])->name('paises');

#Route::get('/paises/departamentos', [DepartamentosController::class, 'getAll'])->name('departamentos');

#Route::get('/paises/departamentos/municipios', [MunicipiosController::class, 'getAll'])->name('municipios');

#Route::get('/paises/{paisId}/departamentos', [PaisesController::class, 'getDepartments']);

#Route::get('/departamentos/{codDepartamento}/municipios', [DepartamentosController::class, 'getMunicipalities'])->where('codDepartamento', '[A-Za-z0-9]+');


//Apis

Route::prefix('api')->group(function () {
    #tipo_documento
    Route::get('/tipo_documento', [TipoDocumentoController::class, 'getAll']);
    Route::get('/tipo_documento/{idTipoDocumento}', [TipoDocumentoController::class, 'findByCod']);
    Route::post('/tipo_documento', [TipoDocumentoController::class, 'store']);
    Route::put('/tipo_documento/{idTipoDocumento}', [TipoDocumentoController::class, 'update']);
    Route::delete('/tipo_documento/{idTipoDocumento}', [TipoDocumentoController::class, 'destroy']);

    #estado_civil
    Route::get('/estado_civil', [EstadoCivilController::class, 'getAll']);
    Route::get('/estado_civil/{codEstadoCivil}', [EstadoCivilController::class, 'findByCod']);

    #estadoUsuario
    Route::get('/estado_usuario', [EstadoUsuarioController::class, 'getAll']);
    Route::get('/estado_usuario/{idEstadoUsuario}', [EstadoUsuarioController::class, 'findById']);

    #Paises, deptos, municipios
    Route::get('/paises', [PaisesController::class, 'getAll']);
    Route::get('/paises/pais', [PaisesController::class, 'findById']);
    Route::get('/pais/departamentos', [PaisesController::class, 'getDepartments']);
    Route::get('/pais/departamento', [PaisesController::class, 'findDepartmentByCod']);
    Route::get('/departamento/municipios', [DepartamentosController::class, 'getMunicipalities']);
    Route::get('/departamento/municipio', [DepartamentosController::class, 'findMunicipalityByCod']);
    Route::get('/municipios/municipio', [MunicipiosController::class, 'findByCod']);

    #direccion
    Route::get('/direccion', [DireccionController::class, 'getAll']);
    Route::get('/direccion/{idDireccion}', [DireccionController::class, 'findByid']);
    Route::post('/direccion', [DireccionController::class, 'store']);
    Route::put('/direccion/{idDireccion}', [DireccionController::class, 'update']);
    Route::delete('/direccion/{idDireccion}', [DireccionController::class, 'destroy']);

    #cargos
    Route::get('/cargos', [CargosController::class, 'getAll']);
    Route::get('/cargos/{idCargo}', [CargosController::class, 'findByid']);
    Route::post('/cargos', [CargosController::class, 'store']);
    Route::put('/cargos/{idCargo}', [CargosController::class, 'update']);
    Route::delete('/cargos/{idCargo}', [CargosController::class, 'destroy']);
    Route::get('/cargo/profesiones', [CargosController::class, 'getProfesiones']);
    Route::get('/cargo/profesion', [CargosController::class, 'findProfesionById']);

    #profesiones
    Route::get('/profesiones', [ProfesionesController::class, 'getAll']);
    Route::get('/profesiones/{idProfesion}', [ProfesionesController::class, 'findByid']);
    Route::post('/profesiones', [ProfesionesController::class, 'store']);
    Route::put('/profesiones/{idProfesion}', [ProfesionesController::class, 'update']);
    Route::delete('/profesiones/{idProfesion}', [ProfesionesController::class, 'destroy']);

    #tipo_telefono
    Route::get('/tipo_telefono', [TipoTelefonoController::class, 'getAll']);
    Route::get('/tipo_telefono/{idTipoTelefono}', [TipoTelefonoController::class, 'findById']);

    #tipo_entidad_usuario
    Route::get('/tipo_entidad', [TipoEntidadUsuarioController::class, 'getAll']);
    Route::get('/tipo_entidad/{idTipoEntidad}', [TipoEntidadUsuarioController::class, 'findById']);

    #estados
    Route::get('/estados', [EstadosController::class, 'getAll']);
    Route::get('/estados/{idEstado}', [EstadosController::class, 'findById']);

    #categoria_nivel
    Route::get('/categoria_nivel', [CategoriaNivelController::class, 'getAll']);
    Route::get('/categoria_nivel/{idCategoriaNivel}', [CategoriaNivelController::class, 'findById']);

    #persona
    Route::get('/personas', [PersonaController::class, 'getAll']);
    Route::get('/persona', [PersonaController::class, 'findByNumDoc']);
    Route::get('/persona/by_email', [PersonaController::class, 'findByEmail']);
    Route::get('/persona/email', [PersonaController::class, 'findEmailByNumDoc']);
    Route::get('/persona/tipo_documento', [PersonaController::class, 'getTipoDocumento']);
    Route::get('/persona/estado_civil', [PersonaController::class, 'getEstadoCivil']);
    Route::get('/persona/profesion', [PersonaController::class, 'getProfesion']);
    Route::get('/persona/direccion', [PersonaController::class, 'getDireccion']);
    Route::post('/personas', [PersonaController::class, 'store']);
    Route::put('/personas/{numDocumento}', [PersonaController::class, 'update']);
    Route::delete('/personas/{numDocumento}', [PersonaController::class, 'destroy']);

    #empresa
    Route::get('/empresas', [EmpresaController::class, 'getAll']);
    Route::get('/empresa', [EmpresaController::class, 'findByNumDoc']);
    Route::get('/empresa/by_nombre', [EmpresaController::class, 'findByNombre']);
    Route::get('/empresa/by_rubro', [EmpresaController::class, 'findByRubro']);
    Route::get('/empresa/email', [EmpresaController::class, 'findEmailByNumDoc']);
    Route::get('/empresa/tipo_documento', [EmpresaController::class, 'getTipoDocumento']);
    Route::get('/empresa/direccion', [EmpresaController::class, 'getDireccion']);
    Route::post('/empresas', [EmpresaController::class, 'store']);
    Route::put('/empresas/{numDocumento}', [EmpresaController::class, 'update']);
    Route::delete('/empresas/{numDocumento}', [EmpresaController::class, 'destroy']);

});