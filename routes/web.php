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
use App\Http\Controllers\ExperienciasLaboralesController;
use App\Http\Controllers\CertificacionesController;
use App\Http\Controllers\ConocimientosAcademicosController;
use App\Http\Controllers\HabilidadesTecnicasController;
use App\Http\Controllers\HabilidadesIdiomasController;
use App\Http\Controllers\RecomendacionesController;
use App\Http\Controllers\LogrosLaboresController;
use App\Http\Controllers\ResultadoPruebasController;
use App\Http\Controllers\ParticipacionEventosController;
use App\Http\Controllers\ArticulosLibrosController;

use App\Http\Controllers\RolesController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\UserController;


//Views locales
// Redirigir la ruta principal a /login
Route::get('/', function () {
    return redirect('/login');
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
    Route::get('/cargo/profesion/ofertas_trab', [CargosController::class, 'getOfertasTrabajoByProfesion']);
    Route::post('/cargos', [CargosController::class, 'store']);
    Route::put('/cargos/{idCargo}', [CargosController::class, 'update']);
    Route::delete('/cargos/{idCargo}', [CargosController::class, 'destroy']);

    #profesiones
    Route::get('/profesiones', [ProfesionesController::class, 'getAll']);
    Route::get('/profesiones/{idProfesion}', [ProfesionesController::class, 'findByid']);
    Route::get('/profesion/cargos', [ProfesionesController::class, 'getCargos']);
    Route::get('/profesion/cargo', [ProfesionesController::class, 'findCargoByIds']);
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
    Route::get('/persona/cargo', [PersonaController::class, 'getCargo']);
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
    Route::get('/empresa/ofertas_trabajo', [EmpresaController::class, 'getOfertasEmpresaByNombre']);
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

    #exp_laborales
    Route::get('/exp_laborales', [ExperienciasLaboralesController::class, 'getAll']);
    Route::get('/exp_laborales/{idExperienciaLaboral}', [ExperienciasLaboralesController::class, 'findById']);
    Route::post('/exp_laborales', [ExperienciasLaboralesController::class, 'store']);
    Route::put('/exp_laborales/{idExperienciaLaboral}', [ExperienciasLaboralesController::class, 'update']);
    Route::delete('/exp_laborales/{idExperienciaLaboral}', [ExperienciasLaboralesController::class, 'destroy']);

    #certificaciones
    Route::get('/certificaciones', [CertificacionesController::class, 'getAll']);
    Route::get('/certificaciones/{idCertificacion}', [CertificacionesController::class, 'findById']);
    Route::post('/certificaciones', [CertificacionesController::class, 'store']);
    Route::put('/certificaciones/{idCertificacion}', [CertificacionesController::class, 'update']);
    Route::delete('/certificaciones/{idCertificacion}', [CertificacionesController::class, 'destroy']);

    #con_academicos
    Route::get('/con_academicos', [ConocimientosAcademicosController::class, 'getAll']);
    Route::get('/con_academicos/{idConocimiento}', [ConocimientosAcademicosController::class, 'findById']);
    Route::post('/con_academicos', [ConocimientosAcademicosController::class, 'store']);
    Route::put('/con_academicos/{idConocimiento}', [ConocimientosAcademicosController::class, 'update']);
    Route::delete('/con_academicos/{idConocimiento}', [ConocimientosAcademicosController::class, 'destroy']);

    #habil_tecnicas
    Route::get('/habil_tecnicas', [HabilidadesTecnicasController::class, 'getAll']);
    Route::get('/habil_tecnicas/{idHabilidadTecnica}', [HabilidadesTecnicasController::class, 'findById']);
    Route::post('/habil_tecnicas', [HabilidadesTecnicasController::class, 'store']);
    Route::put('/habil_tecnicas/{idHabilidadTecnica}', [HabilidadesTecnicasController::class, 'update']);
    Route::delete('/habil_tecnicas/{idHabilidadTecnica}', [HabilidadesTecnicasController::class, 'destroy']);

    #habil_idiomas
    Route::get('/habil_idiomas', [HabilidadesIdiomasController::class, 'getAll']);
    Route::get('/habil_idiomas/{idHabilidadIdioma}', [HabilidadesIdiomasController::class, 'findById']);
    Route::post('/habil_idiomas', [HabilidadesIdiomasController::class, 'store']);
    Route::put('/habil_idiomas/{idHabilidadIdioma}', [HabilidadesIdiomasController::class, 'update']);
    Route::delete('/habil_idiomas/{idHabilidadIdioma}', [HabilidadesIdiomasController::class, 'destroy']);

    #recomendaciones
    Route::get('/recomendaciones', [RecomendacionesController::class, 'getAll']);
    Route::get('/recomendaciones/{idRecomendacion}', [RecomendacionesController::class, 'findById']);
    Route::post('/recomendaciones', [RecomendacionesController::class, 'store']);
    Route::put('/recomendaciones/{idRecomendacion}', [RecomendacionesController::class, 'update']);
    Route::delete('/recomendaciones/{idRecomendacion}', [RecomendacionesController::class, 'destroy']);

    #logros_labores
    Route::get('/logros_labores', [LogrosLaboresController::class, 'getAll']);
    Route::get('/logros_labores/{idLogroLabor}', [LogrosLaboresController::class, 'findById']);
    Route::post('/logros_labores', [LogrosLaboresController::class, 'store']);
    Route::put('/logros_labores/{idLogroLabor}', [LogrosLaboresController::class, 'update']);
    Route::delete('/logros_labores/{idLogroLabor}', [LogrosLaboresController::class, 'destroy']);

    #result_pruebas
    Route::get('/result_pruebas', [ResultadoPruebasController::class, 'getAll']);
    Route::get('/result_pruebas/{idResultadoPrueba}', [ResultadoPruebasController::class, 'findById']);
    Route::post('/result_pruebas', [ResultadoPruebasController::class, 'store']);
    Route::put('/result_pruebas/{idResultadoPrueba}', [ResultadoPruebasController::class, 'update']);
    Route::delete('/result_pruebas/{idResultadoPrueba}', [ResultadoPruebasController::class, 'destroy']);

    #part_eventos
    Route::get('/part_eventos', [ParticipacionEventosController::class, 'getAll']);
    Route::get('/part_eventos/{idEvento}', [ParticipacionEventosController::class, 'findById']);
    Route::post('/part_eventos', [ParticipacionEventosController::class, 'store']);
    Route::put('/part_eventos/{idEvento}', [ParticipacionEventosController::class, 'update']);
    Route::delete('/part_eventos/{idEvento}', [ParticipacionEventosController::class, 'destroy']);

    #arti_libros
    Route::get('/arti_libros', [ArticulosLibrosController::class, 'getAll']);
    Route::get('/arti_libros/{idArticuloLibro}', [ArticulosLibrosController::class, 'findById']);
    Route::post('/arti_libros', [ArticulosLibrosController::class, 'store']);
    Route::put('/arti_libros/{idArticuloLibro}', [ArticulosLibrosController::class, 'update']);
    Route::delete('/arti_libros/{idArticuloLibro}', [ArticulosLibrosController::class, 'destroy']);


    #Autenticación y seguridad

    #roles
    Route::get('/roles', [RolesController::class, 'getAll']);
    Route::get('/roles/{idRol}', [RolesController::class, 'findById']);
    Route::post('/roles', [RolesController::class, 'store']);
    Route::put('/roles/{idRol}', [RolesController::class, 'update']);
    Route::delete('/roles/{idRol}', [RolesController::class, 'destroy']);

    #user
    Route::post('/user/register', [UserController::class, 'register']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::put('/user/{id}/deactivate', [UserController::class, 'deactivate']);
    Route::put('/user/{id}/activate', [UserController::class, 'activate']);
    Route::put('/user/{id}/suspend', [UserController::class, 'suspend']);
    Route::put('/user/{id}/block', [UserController::class, 'block']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
    

    //password
    Route::post('/forgot-password', [UserController::class, 'sendResetLink']);
    Route::post('/change-password', [UserController::class, 'changePassword']);

    #roleuser
    Route::get('/roleuser', [RoleUserController::class, 'getAll']);
    Route::get('/roleuser/{idRol}', [RoleUserController::class, 'findById']);
    Route::post('/roleuser', [RoleUserController::class, 'store']);
    Route::put('/roleuser/{idRol}', [RoleUserController::class, 'update']);
    Route::delete('/roleuser/{idRol}', [RoleUserController::class, 'destroy']);

});

use App\Http\Controllers\FrontendController;

Route::get('/ofertas-laborales', [FrontendController::class, 'ofertas']);

Route::get('/oferta-cvs', [FrontendController::class, 'showAllCvs']);

Route::get('/empresas', [FrontendController::class, 'empresas']);

Route::get('/login', [FrontendController::class, 'login']);
Route::get('/registro', [FrontendController::class, 'registrar']);
Route::get('/persona-view', [FrontendController::class, 'personaView']);

Route::get('/main', [FrontendController::class, 'main']);
Route::get('/cvs', [FrontendController::class, 'cvs']);
Route::get('/change-password', [FrontendController::class, 'changePassword']);