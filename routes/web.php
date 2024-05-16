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
use App\Http\Controllers\TelefonosController;
use App\Http\Controllers\RedesSocialesController;
use App\Http\Controllers\ExperienciaRequeridaController;
use App\Http\Controllers\PerfilPuestoTrabajoController;
use App\Http\Controllers\OfertaTrabajoController;
use App\Http\Controllers\CVsController;
use App\Http\Controllers\SolicitudAspiranteController;



//Views locales

Route::get('/', function () {
    return view('welcome');
});


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
    Route::get('/persona/telefonos', [PersonaController::class, 'getTelefonosByNumDoc']);
    Route::get('/persona/redes_sociales', [PersonaController::class, 'getRedSocByNumDoc']);
    Route::get('/persona/cvs', [PersonaController::class, 'getCVsByNumDoc']);
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
    Route::get('/empresa/telefonos', [EmpresaController::class, 'getTelefonosByNumDoc']);
    Route::get('/empresa/perfiles_puestos', [EmpresaController::class, 'getPerfilesPuestosByNumDoc']);
    Route::post('/empresas', [EmpresaController::class, 'store']);
    Route::put('/empresas/{numDocumento}', [EmpresaController::class, 'update']);
    Route::delete('/empresas/{numDocumento}', [EmpresaController::class, 'destroy']);

    #telefonos
    Route::get('/telefonos', [TelefonosController::class, 'getAll']);
    Route::get('/telefono/by_entidad', [TelefonosController::class, 'findByNumDoc']);
    Route::get('/telefono/by_telefono', [TelefonosController::class, 'findByNumTel']);
    Route::post('/telefonos', [TelefonosController::class, 'store']);
    Route::put('/telefonos/{numTelefono}', [TelefonosController::class, 'update']);
    Route::delete('/telefonos/{numTelefono}', [TelefonosController::class, 'destroy']);

    #redes_sociales
    Route::get('/redes_sociales', [RedesSocialesController::class, 'getAll']);
    Route::get('/redes_sociales/by_numdoc', [RedesSocialesController::class, 'findByNumDoc']);
    Route::post('/redes_sociales', [RedesSocialesController::class, 'store']);
    Route::put('/redes_sociales/{numDocumento}', [RedesSocialesController::class, 'update']);
    Route::delete('/redes_sociales/{numDocumento}', [RedesSocialesController::class, 'destroy']);

    #exp_requeridas
    Route::get('/exp_requeridas', [ExperienciaRequeridaController::class, 'getAll']);
    Route::get('/exp_requerida', [ExperienciaRequeridaController::class, 'findById']);
    Route::post('/exp_requeridas', [ExperienciaRequeridaController::class, 'store']);
    Route::put('/exp_requeridas/{idExperienciaRequerida}', [ExperienciaRequeridaController::class, 'update']);
    Route::delete('/exp_requeridas/{idExperienciaRequerida}', [ExperienciaRequeridaController::class, 'destroy']);

    #perfiles_puestos
    Route::get('/perfiles_puestos', [PerfilPuestoTrabajoController::class, 'getAll']);
    Route::get('/perfil_puesto', [PerfilPuestoTrabajoController::class, 'findById']);
    Route::post('/perfiles_puestos', [PerfilPuestoTrabajoController::class, 'store']);
    Route::put('/perfiles_puestos/{idPerfilPuesto}', [PerfilPuestoTrabajoController::class, 'update']);
    Route::delete('/perfiles_puestos/{idPerfilPuesto}', [PerfilPuestoTrabajoController::class, 'destroy']);

    #oferta_laboral
    Route::get('/ofertas_laborales', [OfertaTrabajoController::class, 'getAll']);
    Route::get('/oferta_laboral', [OfertaTrabajoController::class, 'findById']);
    Route::post('/oferta_laboral', [OfertaTrabajoController::class, 'store']);
    Route::put('/oferta_laboral/{idOfertaLaboral}', [OfertaTrabajoController::class, 'update']);
    Route::delete('/oferta_laboral/{idOfertaLaboral}', [OfertaTrabajoController::class, 'destroy']);

    #cv
    Route::get('/cvs', [CVsController::class, 'getAll']);
    Route::get('/cvs/solicitudes', [CVsController::class, 'getSolicitudesCVsByNumDoc']);
    Route::get('/cv/by_id', [CVsController::class, 'findById']);
    Route::post('/cv', [CVsController::class, 'store']);
    Route::put('/cv/{idCurriculum}', [CVsController::class, 'update']);
    Route::delete('/cv/{idCurriculum}', [CVsController::class, 'destroy']);

    #soli_aspirante
    Route::get('/soli_aspirantes', [SolicitudAspiranteController::class, 'getAll']);
    Route::get('/soli_aspirante/{idCurriculum}/{idOfertaLaboral}', [SolicitudAspiranteController::class, 'findByIds']);
    Route::post('/soli_aspirante', [SolicitudAspiranteController::class, 'store']);
    Route::put('/soli_aspirante/{idCurriculum}/{idOfertaLaboral}', [SolicitudAspiranteController::class, 'update']);
    Route::delete('/soli_aspirante/{idCurriculum}/{idOfertaLaboral}', [SolicitudAspiranteController::class, 'destroy']);


});