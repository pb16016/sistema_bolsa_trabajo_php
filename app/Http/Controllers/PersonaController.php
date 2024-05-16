<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\Persona;

class PersonaController extends Controller
{
    public function getAll()
    {
        try {
            $personas = Persona::all();
            return response()->json($personas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las personas. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function findByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $persona = Persona::findOrFail($numDocumento);
            $persona->tipoDocumento;
            $persona->estadoCivil;
            $persona->profesion->cargo;
            $persona->direccion->municipio->departamento->pais;
            $telefonos = $persona->documentoEntidad->telefonos;
            
            foreach ($telefonos as $telefono) {
                $telefono->pais;
                $telefono->tipoTelefono;
            }

            $persona->redesSociales;

            if ($persona) {
                return response()->json($persona);
            } else {
                return response()->json(['message' => 'Persona no encontrada para el número de documento proporcionado.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Persona no encontrada. Detalles: ' . $e->getMessage()], 404);
        }
    }

    public function findEmailByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $persona = Persona::findOrFail($numDocumento);

            if ($persona) {
                $email = $persona->emailPersona;
                return response()->json(['email' => $email]);

            } else {
                return response()->json(['message' => 'Persona no encontrada para el número de documento proporcionado.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Persona no encontrada. Detalles: ' . $e->getMessage()], 404);
        }
    }

    public function findByEmail()
    {
        try {
            $emailPersona = request('emailPersona');
            $persona = Persona::where('emailPersona', $emailPersona)->first();

            if ($persona) {
                $persona->tipoDocumento;
                $persona->estadoCivil;
                $persona->profesion->cargo;
                $persona->direccion->municipio->departamento->pais;
                $telefonos = $persona->documentoEntidad->telefonos;
            
                foreach ($telefonos as $telefono) {
                    $telefono->pais;
                    $telefono->tipoTelefono;
                }

                $persona->redesSociales;

                return response()->json($persona);
            } else {
                return response()->json(['message' => 'Persona no encontrada para el correo electrónico proporcionado.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar persona por correo electrónico. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function getCVsByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $persona = Persona::findOrFail($numDocumento);
            $cvs = $persona->CVs;
            
            $response = [];
            foreach ($cvs as $cv) {
                $experienciasLaborales = $cv->experienciasLaborales;
                foreach ($experienciasLaborales as $experienciaLaboral) {
                    // Acciones con $experienciaLaboral
                }
                $certificaciones = $cv->certificaciones;
                foreach ($certificaciones as $certificacion) {
                    // Acciones con $certificacion
                }
                $conocimientosAcademicos = $cv->conocimientosAcademicos;
                foreach ($conocimientosAcademicos as $conocimientoAcademico) {
                    // Acciones con $conocimientoAcademico
                }
                $habilidadesTecnicas = $cv->habilidadesTecnicas;
                foreach ($habilidadesTecnicas as $habilidadTecnica) {
                    // Acciones con $habilidadTecnica
                }
                $habilidadesIdiomas = $cv->habilidadesIdiomas;
                foreach ($habilidadesIdiomas as $habilidadIdioma) {
                    $habilidadIdioma->categoriaNivel;
                }
                $recomendaciones = $cv->recomendaciones;
                foreach ($recomendaciones as $recomendacion) {
                    // Acciones con $recomendacion
                }
                $logrosLabores = $cv->logrosLabores;
                foreach ($logrosLabores as $logroLaboral) {
                    // Acciones con $logroLaboral
                }
                $resultadosPruebas = $cv->resultadosPruebas;
                foreach ($resultadosPruebas as $resultadoPrueba) {
                    // Acciones con $resultadoPrueba
                }
                $participacionEventos = $cv->participacionEventos;
                foreach ($participacionEventos as $participacionEvento) {
                    // Acciones con $participacionEvento
                }
                $articulosLibros = $cv->articulosLibros;
                foreach ($articulosLibros as $articuloLibro) {
                    // Acciones con $articuloLibro
                }

                $response[] = $cv;
            }
            
            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los CVs de la persona. Detalles: ' . $e->getMessage()], 404);
        }
    }

    public function getTelefonosByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $persona = Persona::findOrFail($numDocumento);
            $telefonos = $persona->documentoEntidad->telefonos;
            
            foreach ($telefonos as $telefono) {
                $telefono->pais;
                $telefono->tipoTelefono;
            }

            if ($telefonos) {
                return response()->json($telefonos);
            } else {
                return response()->json(['message' => 'Telefonos no encontrados para el número de documento proporcionado.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los telefónos de la persona. Detalles: ' . $e->getMessage()], 404);
        }
    }

    public function getRedSocByNumDoc()
    {
        try {
            $numDocumento = request('numDocumento');
            $persona = Persona::findOrFail($numDocumento);

            if (!is_null($persona->redesSociales)) {
                $redesSociales = $persona->redesSociales;
                return response()->json($redesSociales);
            } else {
                return response()->json(['message' => 'Redes sociales no encontrados para el número de documento proporcionado.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las redes sociales de la persona. Detalles: ' . $e->getMessage()], 404);
        }
    }

    public function getTipoDocumento()
    {
        try {
            $numDocumento = request('numDocumento');
            $persona = Persona::findOrFail($numDocumento);

            if (!is_null($persona->tipoDocumento)) {
                $tipoDocumento = $persona->tipoDocumento;
                return response()->json($tipoDocumento);
            } else {
                return response()->json(["message" => "No se encontraron tipo de documentos para esta persona."], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el tipo de documento de la persona. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function getEstadoCivil()
    {
        try {
            $numDocumento = request('numDocumento');
            $persona = Persona::findOrFail($numDocumento);
            
            if (!is_null($persona->estadoCivil)) {
                $estadoCivil = $persona->estadoCivil;
                return response()->json($estadoCivil);

            } else {
                return response()->json(["message" => "No se encontró un estado civil para esta persona."], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el estado civil de la persona. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function getProfesion()
    {
        try {
            $numDocumento = request('numDocumento');
            $persona = Persona::findOrFail($numDocumento);
            
            if (!is_null($persona->profesion)) {
                $profesion = $persona->profesion;
                $persona->profesion->cargo;

                return response()->json($profesion);
            } else {
                return response()->json(["message" => "No se encontró profesión para esta persona."], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la profesión de la persona. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function getDireccion()
    {
        try {
            $numDocumento = request('numDocumento');
            $persona = Persona::findOrFail($numDocumento);
            
            if (!is_null($persona->direccion)) {
                $direccion = $persona->direccion;
                $persona->direccion->municipio->departamento->pais;

                return response()->json($direccion);
            } else {
                return response()->json(["message" => "No se encontró una dirección para esta persona."], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la dirección de la persona. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'numDocumento' => 'required|unique:persona|max:20',
                'primerNombre' => 'required|max:15',
                'segundoNombre' => 'required|max:15',
                'primerApellido' => 'required|max:15',
                'segundoApellido' => 'required|max:15',
                'fechaNacimiento' => 'required|date',
                'emailPersona' => 'required|email|max:50',
                'genero' => 'required|in:M,F',
                'NIT' => 'required|max:20',
                'codEstadoCivil' => 'required|exists:estadoscivil,codEstadoCivil',
                'idTipoDocumento' => 'required|exists:tipodocumento,idTipoDocumento',
                'idProfesion' => 'required|exists:profesiones,idProfesion',
                'idDireccion' => 'required|exists:direccion,idDireccion',
            ]);

            $persona = Persona::create($request->all());

            return response()->json(['message' => 'Persona creada exitosamente.', 'data' => $persona], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al crear la persona. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la persona. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $numDocumento)
    {
        try {
            $request->validate([
                'primerNombre' => 'required|max:15',
                'segundoNombre' => 'required|max:15',
                'primerApellido' => 'required|max:15',
                'segundoApellido' => 'required|max:15',
                'fechaNacimiento' => 'required|date',
                'emailPersona' => 'required|email|max:50',
                'genero' => 'required|in:M,F',
                'NIT' => 'required|max:20',
                'codEstadoCivil' => 'required|exists:estadoscivil,codEstadoCivil',
                'idTipoDocumento' => 'required|exists:tipodocumento,idTipoDocumento',
                'idProfesion' => 'required|exists:profesiones,idProfesion',
                'idDireccion' => 'required|exists:direccion,idDireccion',
            ]);

            $persona = Persona::findOrFail($numDocumento);
            $persona->update($request->all());

            return response()->json(['message' => 'Persona actualizada exitosamente.', 'data' => $persona]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Persona no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error de validación al actualizar la persona. Detalles: ' . $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la persona. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($numDocumento)
    {
        try {
            $persona = Persona::findOrFail($numDocumento);
            $persona->delete();

            return response()->json(['message' => 'Persona eliminada exitosamente.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Persona no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la persona. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
