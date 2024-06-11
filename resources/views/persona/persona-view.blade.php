<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de la Persona</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f2f2;
        }
        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        .section-title {
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #007bff;
        }
        table {
            margin-bottom: 30px;
        }
        th {
            width: 200px;
            background-color: #f8f9fa;
        }
        td {
            background-color: #e9ecef;
        }
        .table-hover tbody tr:hover {
            background-color: #d1ecf1;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }
        #email {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Información de la Persona</h1>
            <span id="email">{{ $email }}</span>
        </div>
        <div id="persona-info" class="mt-4">
            <p>Cargando información...</p>
        </div>
        <button id="update-info-btn" class="btn btn-primary mt-3">Actualizar Información</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <div class="form-group">
                            <label for="primerNombre">Primer Nombre</label>
                            <input type="text" class="form-control" id="primerNombre" name="primerNombre">
                        </div>
                        <div class="form-group">
                            <label for="segundoNombre">Segundo Nombre</label>
                            <input type="text" class="form-control" id="segundoNombre" name="segundoNombre">
                        </div>
                        <div class="form-group">
                            <label for="primerApellido">Primer Apellido</label>
                            <input type="text" class="form-control" id="primerApellido" name="primerApellido">
                        </div>
                        <div class="form-group">
                            <label for="segundoApellido">Segundo Apellido</label>
                            <input type="text" class="form-control" id="segundoApellido" name="segundoApellido">
                        </div>
                        <div class="form-group">
                            <label for="apellidoCasado">Apellido de Casado</label>
                            <input type="text" class="form-control" id="apellidoCasado" name="apellidoCasado">
                        </div>
                        <div class="form-group">
                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
                        </div>
                        <div class="form-group">
                            <label for="emailPersona">Correo Electrónico</label>
                            <input type="email" class="form-control" id="emailPersona" name="emailPersona">
                        </div>
                        <div class="form-group">
                            <label for="genero">Género</label>
                            <select class="form-control" id="genero" name="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="NIT">NIT</label>
                            <input type="text" class="form-control" id="NIT" name="NIT">
                        </div>
                        <div class="form-group">
                            <label for="codEstadoCivil">Estado Civil</label>
                            <input type="text" class="form-control" id="codEstadoCivil" name="codEstadoCivil">
                        </div>
                        <div class="form-group" style="display: none;"> <!-- Campo oculto -->
                            <label for="idTipoDocumento">idTipoDocumento</label>
                            <input type="text" class="form-control" id="idTipoDocumento" name="idTipoDocumento">
                        </div>
                        <div class="form-group" style="display: none;"> <!-- Campo oculto -->
                            <label for="idCargo">Cargo</label>
                            <input type="text" class="form-control" id="idCargo" name="idCargo">
                        </div>
                        <div class="form-group" style="display: none;"> <!-- Campo oculto -->
                            <label for="idDireccion">Dirección</label>
                            <input type="text" class="form-control" id="idDireccion" name="idDireccion">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var email = $('#email').text();

            $.ajax({
                url: '/api/persona/by_email',
                method: 'GET',
                data: { emailPersona: email },
                success: function(response) {
                    if (response.message) {
                        $('#persona-info').html('<p>' + response.message + '</p>');
                    } else {
                        var persona = response;
                        var personaHtml = `
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="section-title">Datos Personales</h2>
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr><th scope="row">Número de Documento</th><td>${persona.numDocumento}</td></tr>
                                            <tr><th scope="row">Primer Nombre</th><td>${persona.primerNombre}</td></tr>
                                            <tr><th scope="row">Segundo Nombre</th><td>${persona.segundoNombre}</td></tr>
                                            <tr><th scope="row">Primer Apellido</th><td>${persona.primerApellido}</td></tr>
                                            <tr><th scope="row">Segundo Apellido</th><td>${persona.segundoApellido}</td></tr>
                                            <tr><th scope="row">Apellido de Casado</th><td>${persona.apellidoCasado || 'No contiene'}</td></tr>
                                            <tr><th scope="row">Fecha de Nacimiento</th><td>${persona.fechaNacimiento}</td></tr>
                                            <tr><th scope="row">Correo Electrónico</th><td>${persona.emailPersona}</td></tr>
                                            <tr><th scope="row">Género</th><td>${persona.genero === 'M' ? 'Masculino' : 'Femenino'}</td></tr>
                                            <tr><th scope="row">NIT</th><td>${persona.NIT}</td></tr>
                                            <tr><th scope="row">NUP</th><td>${persona.NUP || 'No contiene'}</td></tr>
                                            <tr><th scope="row">Estado Civil</th><td>${persona.estado_civil.EstadoCivil}</td></tr>
                                            <tr><th scope="row">Tipo de Documento</th><td>${persona.tipo_documento.descripcion}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="section-title">Detalles de Dirección</h2>
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr><th scope="row">Dirección</th><td>${persona.direccion.direccion}</td></tr>
                                            <tr><th scope="row">Detalle de Dirección</th><td>${persona.direccion.detalleDireccion}</td></tr>
                                            <tr><th scope="row">Municipio</th><td>${persona.direccion.municipio.nombreMunicipio}</td></tr>
                                            <tr><th scope="row">Departamento</th><td>${persona.direccion.municipio.departamento.nombreDepartamento}</td></tr>
                                            <tr><th scope="row">País</th><td>${persona.direccion.municipio.departamento.pais.nombrePais}</td></tr>
                                        </tbody>
                                    </table>
                                    <h2 class="section-title">Detalles de Cargo</h2>
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr><th scope="row">Cargo</th><td>${persona.cargo.nombreCargo}</td></tr>
                                            <tr><th scope="row">Descripción</th><td>${persona.cargo.descripcion}</td></tr>
                                            <tr><th scope="row">Profesión</th><td>${persona.cargo.profesion.nombreProfesion}</td></tr>
                                        </tbody>
                                    </table>
                                    <h2 class="section-title">Redes Sociales</h2>
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr><th scope="row">Facebook</th><td>${persona.redes_sociales?.facebook || 'No contiene'}</td></tr>
                                            <tr><th scope="row">LinkedIn</th><td>${persona.redes_sociales?.linkedin || 'No contiene'}</td></tr>
                                            <tr><th scope="row">WhatsApp</th><td>${persona.redes_sociales?.whatsApp || 'No contiene'}</td></tr>
                                            <tr><th scope="row">Instagram</th><td>${persona.redes_sociales?.instagram || 'No contiene'}</td></tr>
                                            <tr><th scope="row">Twitter</th><td>${persona.redes_sociales?.twitter || 'No contiene'}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `;
                        $('#persona-info').html(personaHtml);

                        $('#updateForm #primerNombre').val(persona.primerNombre);
                        $('#updateForm #segundoNombre').val(persona.segundoNombre);
                        $('#updateForm #primerApellido').val(persona.primerApellido);
                        $('#updateForm #segundoApellido').val(persona.segundoApellido);
                        $('#updateForm #apellidoCasado').val(persona.apellidoCasado);
                        $('#updateForm #fechaNacimiento').val(persona.fechaNacimiento);
                        $('#updateForm #emailPersona').val(persona.emailPersona);
                        $('#updateForm #genero').val(persona.genero);
                        $('#updateForm #NIT').val(persona.NIT);
                        $('#updateForm #codEstadoCivil').val(persona.codEstadoCivil);
                        $('#updateForm #idTipoDocumento').val(persona.idTipoDocumento);
                        $('#updateForm #idCargo').val(persona.idCargo);
                        $('#updateForm #idDireccion').val(persona.idDireccion);
                    }
                },
                error: function(xhr, status, error) {
                    $('#persona-info').html('<p>Error al cargar la información de la persona.</p>');
                }
            });

            $('#update-info-btn').on('click', function() {
                $('#updateModal').modal('show');
            });

            $('#updateForm').on('submit', function(event) {
                event.preventDefault();
                var numDocumento = response.numDocumento; // Obtener el número de documento actual
                var formData = $(this).serialize();

                $.ajax({
                    url: '/api/personas/' + numDocumento,
                    method: 'PUT',
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        $('#updateModal').modal('hide');
                        location.reload(); // Recargar la página para ver los cambios
                    },
                    error: function(xhr, status, error) {
                        alert('Error al actualizar la información de la persona.');
                    }
                });
            });
        });
    </script>
</body>
</html>
