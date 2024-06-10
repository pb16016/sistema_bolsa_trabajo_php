<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas Laborales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Agregado -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 1rem;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right mb-2">
                <button class="btn btn-primary" id="verSolicitudesBtn">Ver sus Solicitudes de Trabajo</button>
            </div>
        </div>
        <h1 class="text-center mb-4">Ofertas Laborales</h1>
        <div id="ofertas-list" class="row">
            <!-- Aquí se insertarán las ofertas laborales -->
        </div>
    </div>

    <!-- Modal para seleccionar CV -->
    <div class="modal fade" id="selectCVModal" tabindex="-1" role="dialog" aria-labelledby="selectCVModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectCVModalLabel">Seleccionar CV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="cvs-list">
                        <!-- Aquí se insertarán los CVs -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="applyCVBtn">Aplicar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#verSolicitudesBtn').click(function() {
                $.ajax({
                    url: '/api/cvs/solicitudes',
                    method: 'GET',
                    success: function(data) {
                        $('#solicitudesModal').modal('show');
                        let modalBody = $('#solicitudes-details');
                        modalBody.empty();
                        data.forEach(function(cv) {
                            let cvHTML = `
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <strong>Número de Documento:</strong> ${cv.numDocumento}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Solicitudes de Trabajo</h5>
                            `;
                            cv.solicitudes_cv.forEach(function(solicitud) {
                                cvHTML += `
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <strong>Fecha de Solicitud:</strong> ${solicitud.fechaSolicitud}
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Estado de la Solicitud:</strong> ${solicitud.estado_solicitud.nombreEstado}</p>
                                            <p><strong>Oferta de Trabajo:</strong></p>
                                            <p><strong>Nombre del Puesto:</strong> ${solicitud.oferta_trabajo.perfil_puesto.nombrePuesto}</p>
                                            <p><strong>Rango Salarial:</strong> ${solicitud.oferta_trabajo.perfil_puesto.rangoSalarial}</p>
                                            <p><strong>Modalidad de Trabajo:</strong> ${solicitud.oferta_trabajo.perfil_puesto.modalidadTrabajo}</p>
                                            <p><strong>Ubicación Geográfica:</strong> ${solicitud.oferta_trabajo.perfil_puesto.ubicacionGeografica}</p>
                                            <p><strong>Beneficios:</strong> ${solicitud.oferta_trabajo.perfil_puesto.beneficios}</p>
                                            <p><strong>Grado Académico Mínimo:</strong> ${solicitud.oferta_trabajo.perfil_puesto.gradoAcademicoMinimo}</p>
                                            <p><strong>Requisitos Adicionales:</strong> ${solicitud.oferta_trabajo.perfil_puesto.requisitosAdicionales}</p>
                                        </div>
                                    </div>
                                `;
                            });
                            cvHTML += `</div></div>`;
                            modalBody.append(cvHTML);
                        });
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });

            $(document).on('click', '.applyBtn', function() {
                let ofertaId = $(this).data('id');
                $('#selectCVModal').modal('show');

                // Obtener los CVs y mostrarlos en el modal
                $.ajax({
                    url: '/api/cvs',
                    method: 'GET',
                    success: function(data) {
                        let cvsList = $('#cvs-list');
                        cvsList.empty();
                        data.forEach(function(cv) {
                            cvsList.append(`
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cvRadio" id="cvRadio_${cv.idCurriculum}" value="${cv.idCurriculum}">
                                    <label class="form-check-label" for="cvRadio_${cv.idCurriculum}">
                                        ${cv.descripcion}
                                    </label>
                                </div>
                            `);
                        });
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });

                // Manejar clic en el botón Aplicar dentro del modal
                $('#applyCVBtn').off().on('click', function() {
                    let selectedCV = $('input[name=cvRadio]:checked').val();
                    if (selectedCV) {
                        // Enviar solicitud POST para crear la solicitud de aspirante
                        $.ajax({
                            url: '/api/soli_aspirante',
                            method: 'POST',
                            data: {
                                idCurriculum: selectedCV,
                                idOfertaLaboral: ofertaId,
                                fechaSolicitud: new Date().toISOString().slice(0, 10), // Fecha actual
                            },
                            success: function(response) {
                                alert(response.message);
                                $('#selectCVModal').modal('hide');
                            },
                            error: function(error) {
                                console.log('Error:', error.responseJSON);
                                alert('Error al aplicar. Por favor, inténtelo de nuevo.');
                            }
                        });
                    } else {
                        alert('Por favor, seleccione un CV para aplicar.');
                    }
                });
            });

            $.ajax({
                url: '/api/ofertas_laborales',
                method: 'GET',
                success: function(data) {
                    let ofertasList = $('#ofertas-list');
                    data.forEach(function(oferta) {
                        let perfil = oferta.perfil_puesto;
                        ofertasList.append(`
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">${perfil.nombrePuesto}</h5>
                                        <p class="card-text"><strong>Descripción:</strong> ${oferta.descripcion}</p>
                                        <p class="card-text"><strong>Rango Salarial:</strong> ${perfil.rangoSalarial}</p>
                                        <p class="card-text"><strong>Modalidad:</strong> ${perfil.modalidadTrabajo}</p>
                                        <p class="card-text"><strong>Ubicación:</strong> ${perfil.ubicacionGeografica}</p>
                                        <p class="card-text"><strong>Beneficios:</strong> ${perfil.beneficios}</p>
                                        <p class="card-text"><strong>Grado Académico Mínimo:</strong> ${perfil.gradoAcademicoMinimo}</p>
                                        <p class="card-text"><strong>Requisitos Adicionales:</strong> ${perfil.requisitosAdicionales}</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary btn-block applyBtn" data-id="${oferta.idOfertaLaboral}">Aplicar</button>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });
    </script>

    <!-- Modal para mostrar las solicitudes de trabajo -->
    <div class="modal fade" id="solicitudesModal" tabindex="-1" role="dialog" aria-labelledby="solicitudesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="solicitudesModalLabel">Solicitudes de Trabajo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="solicitudes-details">
                <!-- Aquí se insertarán las solicitudes de trabajo -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
