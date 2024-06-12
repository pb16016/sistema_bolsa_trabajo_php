<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            margin-top: 50px;
        }
        .card {
            width: 700px;
            margin: 0 auto;
            padding: 20px;
        }
        .card-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-register {
            width: 100%;
        }
        .nav-tabs {
            margin-bottom: 20px;
        }
        .tab-content {
            border: 1px solid #dee2e6;
            border-top: none;
            padding: 20px;
            background-color: #fff;
        }
        .tab-pane {
            margin-top: 20px;
        }
        .section-title {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 1.2em;
            font-weight: bold;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container register-container">
        <div class="card">
            <h2 class="card-title">Registro de Usuario</h2>
            <h2 class="card-title"></h2>
            <h4 class="card-title">Datos del usuario</h4>
            <h4 class="card-title"></h4>
            <h7 class="card-title">Siga las pestañas de ingreso de datos:</h7>
            <ul class="nav nav-tabs" id="registerTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="professional-tab" data-toggle="tab" href="#professional" role="tab" aria-controls="professional" aria-selected="false">Profesionales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">Seguridad</a>
                </li>
            </ul>
            <form id="registerForm">
                @csrf <!-- Incluye el token CSRF -->
                <div class="tab-content" id="registerTabsContent">
                    <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                        <div class="form-group">
                            <label for="primerNombre">Primer Nombre *</label>
                            <input type="text" class="form-control" id="primerNombre" name="primerNombre" required>
                        </div>
                        <div class="form-group">
                            <label for="segundoNombre">Segundo Nombre *</label>
                            <input type="text" class="form-control" id="segundoNombre" name="segundoNombre">
                        </div>
                        <div class="form-group">
                            <label for="primerApellido">Primer Apellido *</label>
                            <input type="text" class="form-control" id="primerApellido" name="primerApellido" required>
                        </div>
                        <div class="form-group">
                            <label for="segundoApellido">Segundo Apellido *</label>
                            <input type="text" class="form-control" id="segundoApellido" name="segundoApellido">
                        </div>
                        <div class="form-group">
                            <label for="apellidoCasado">Apellido de Casado</label>
                            <input type="text" class="form-control" id="apellidoCasado" name="apellidoCasado" placeholder="Opcional" onfocus="if(this.placeholder === 'Opcional') { this.placeholder = ''; }" onblur="if(this.placeholder === '') { this.placeholder = 'Opcional'; }">
                        </div>
                        <div class="form-group">
                            <label for="fechaNacimiento">Fecha de Nacimiento *</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                        </div>
                        <div class="form-group">
                            <label for="idTipoDocumento">Tipo de Documento *</label>
                            <select class="form-control" id="idTipoDocumento" name="idTipoDocumento" required>
                                <option value="">Seleccione un tipo de documento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="numDocumento">Número de Documento *</label>
                            <input type="text" class="form-control" id="numDocumento" name="numDocumento" required>
                        </div>
                        <div class="form-group">
                            <label for="NIT">NIT *</label>
                            <input type="text" class="form-control" id="NIT" name="NIT" required>
                        </div>
                        <div class="form-group">
                            <label for="NUP">NUP</label>
                            <input type="text" class="form-control" id="NUP" name="NUP" placeholder="Opcional" onfocus="if(this.placeholder === 'Opcional') { this.placeholder = ''; }" onblur="if(this.placeholder === '') { this.placeholder = 'Opcional'; }">
                        </div>
                        <div class="form-group">
                            <label for="codEstadoCivil">Estado Civil *</label>
                            <select class="form-control" id="codEstadoCivil" name="codEstadoCivil" required>
                                <option value="">Seleccione un estado civil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="genero">Género *</label>
                            <select class="form-control" id="genero" name="genero" required>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="form-group">
                            <label for="emailPersona">Correo Electrónico *</label>
                            <input type="email" class="form-control" id="emailPersona" name="emailPersona" required>
                        </div>
                        <div class="form-group">
                            <label for="idPais">País *</label>
                            <select class="form-control" id="idPais" name="idPais" required>
                                <option value="">Seleccione un país</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="codDepartamento">Departamento *</label>
                            <select class="form-control" id="codDepartamento" name="codDepartamento" required>
                                <option value="">Seleccione un departamento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="codMunicipio">Municipio *</label>
                            <select class="form-control" id="codMunicipio" name="codMunicipio" required>
                                <option value="">Seleccione un municipio</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección *</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="detalleDireccion">Detalle de Dirección *</label>
                            <input type="text" class="form-control" id="detalleDireccion" name="detalleDireccion" required>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="professional" role="tabpanel" aria-labelledby="professional-tab">
                        <div class="form-group">
                            <label for="idProfesion">Profesiones *</label>
                            <select class="form-control" id="idProfesion" name="idProfesion" required>
                                <option value="">Seleccione una profesión</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="idCargo">Cargo *</label>
                            <select class="form-control" id="idCargo" name="idCargo" required>
                                <option value="">Seleccione un cargo</option>
                            </select>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <div class="form-group">
                            <label for="username">Nombre de Usuario *</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña *</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-register">Registrarse</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
            // Configura los headers de jQuery para incluir el token CSRF
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Cargar tipos de documento
            $.ajax({
                url: '/api/tipo_documento',
                method: 'GET',
                success: function(response) {
                    var tipoDocumentoSelect = $('#idTipoDocumento');
                    response.forEach(function(tipoDocumento) {
                        tipoDocumentoSelect.append(new Option(tipoDocumento.descripcion, tipoDocumento.idTipoDocumento));
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error al cargar los tipos de documento.');
                }
            });

            $.ajax({
                url: '/api/estado_civil',
                method: 'GET',
                success: function(response) {
                    var estadoCivilSelect = $('#codEstadoCivil');
                    response.forEach(function(estadoCivil) {
                        estadoCivilSelect.append(new Option(estadoCivil.EstadoCivil, estadoCivil.codEstadoCivil));
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error al cargar los estados civiles.');
                }
            });

            // Cargar profesiones
            $.ajax({
                url: '/api/profesiones',
                method: 'GET',
                success: function(response) {
                    var profesionSelect = $('#idProfesion');
                    response.forEach(function(profesion) {
                        profesionSelect.append(new Option(profesion.nombreProfesion, profesion.idProfesion));
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error al cargar las profesiones.');
                }
            });
            
            // Cargar cargos por profesión seleccionada
            $('#idProfesion').change(function() {
                var idProfesion = $(this).val();
                $.ajax({
                    url: '/api/profesion/cargos?idProfesion=' + idProfesion,
                    method: 'GET',
                    success: function(response) {
                        var cargoSelect = $('#idCargo');
                        cargoSelect.empty(); // Limpiar opciones anteriores
                        if (response.length > 0) {
                            response.forEach(function(cargo) {
                                cargoSelect.append(new Option(cargo.nombreCargo, cargo.idCargo));
                            });
                        } else {
                            cargoSelect.append(new Option('Sin cargos disponibles', ''));
                        }
                    },
                    error: function(xhr, status, error) {
                        var cargoSelect = $('#idCargo');
                        cargoSelect.empty(); // Limpiar opciones anteriores
                        cargoSelect.append(new Option('Sin cargos disponibles', ''));
                        alert('Error al cargar los cargos.');
                    }
                });
            });

            // Cargar países
            $.ajax({
                url: '/api/paises',
                method: 'GET',
                success: function(response) {
                    var paisSelect = $('#idPais');
                    paisSelect.empty(); // Limpiar opciones anteriores
                    paisSelect.append(new Option('Seleccione un país', ''));
                    response.forEach(function(pais) {
                        paisSelect.append(new Option(pais.nombrePais, pais.idPais));
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error al cargar los países.');
                }
            });

            // Cargar departamentos por país seleccionado
            $('#idPais').change(function() {
                var idPais = $(this).val();
                $.ajax({
                    url: '/api/pais/departamentos?idPais=' + idPais,
                    method: 'GET',
                    success: function(response) {
                        var departamentoSelect = $('#codDepartamento');
                        departamentoSelect.empty(); // Limpiar opciones anteriores
                        departamentoSelect.append(new Option('Seleccione un departamento', ''));
                        response.forEach(function(departamento) {
                            departamentoSelect.append(new Option(departamento.nombreDepartamento, departamento.codDepartamento));
                        });
                    },
                    error: function(xhr, status, error) {
                        var departamentoSelect = $('#codDepartamento');
                        departamentoSelect.empty(); // Limpiar opciones anteriores
                        departamentoSelect.append(new Option('Seleccione un departamento', ''));
                        alert('Error al cargar los departamentos.');
                    }
                });
            });

            // Cargar municipios por departamento seleccionado
            $('#codDepartamento').change(function() {
                var codDepartamento = $(this).val();
                $.ajax({
                    url: '/api/departamento/municipios?codDepartamento=' + codDepartamento,
                    method: 'GET',
                    success: function(response) {
                        var municipioSelect = $('#codMunicipio');
                        municipioSelect.empty(); // Limpiar opciones anteriores
                        municipioSelect.append(new Option('Seleccione un municipio', ''));
                        response.forEach(function(municipio) {
                            municipioSelect.append(new Option(municipio.nombreMunicipio, municipio.codMunicipio));
                        });
                    },
                    error: function(xhr, status, error) {
                        var municipioSelect = $('#codMunicipio');
                        municipioSelect.empty(); // Limpiar opciones anteriores
                        municipioSelect.append(new Option('Seleccione un municipio', ''));
                        alert('Error al cargar los municipios.');
                    }
                });
            });

            $('#registerForm').submit(function(event) {
                event.preventDefault();

                var direccionData = {
                    direccion: $('#direccion').val(),
                    detalleDireccion: $('#detalleDireccion').val(),
                    codMunicipio: $('#codMunicipio').val()
                };

                $.ajax({
                    url: '/api/direccion',
                    method: 'POST',
                    data: direccionData,
                    success: function(response) {
                        var idDireccion = response.data.idDireccion;

                        var personaData = {
                            numDocumento: $('#numDocumento').val(),
                            primerNombre: $('#primerNombre').val(),
                            segundoNombre: $('#segundoNombre').val(),
                            primerApellido: $('#primerApellido').val(),
                            segundoApellido: $('#segundoApellido').val(),
                            apellidoCasado: $('#apellidoCasado').val(),
                            fechaNacimiento: $('#fechaNacimiento').val(),
                            emailPersona: $('#emailPersona').val(),
                            genero: $('#genero').val(),
                            NIT: $('#NIT').val(),
                            NUP: $('#NUP').val(),
                            codEstadoCivil: $('#codEstadoCivil').val(),
                            idTipoDocumento: $('#idTipoDocumento').val(),
                            idCargo: $('#idCargo').val(),
                            idDireccion: idDireccion // Usar el ID de dirección obtenido en la respuesta
                        };

                        var userData = {
                            username: $('#username').val(),
                            email: $('#emailPersona').val(), // Usar el mismo email que el de persona
                            password: $('#password').val(),
                            password_confirmation: $('#password_confirmation').val()
                        };

                        $.ajax({
                            url: '/api/personas',
                            method: 'POST',
                            data: personaData,
                            success: function(response) {
                                $.ajax({
                                    url: '/api/user/register',
                                    method: 'POST',
                                    data: userData,
                                    success: function(response) {
                                        alert('Registro exitoso');
                                        window.location.href = '/login';
                                    },
                                    error: function(xhr, status, error) {
                                        var errorMessage = xhr.responseJSON.error;
                                        alert('Error al registrar usuario: ' + errorMessage);
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                var errorMessage = xhr.responseJSON.error;
                                alert('Error al registrar persona: ' + errorMessage);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.error;
                        alert('Error al registrar dirección: ' + errorMessage);
                    }
                });
            });
        });
</script>