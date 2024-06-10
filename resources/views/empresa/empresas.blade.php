<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empresas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.2s ease-in-out;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            border-radius: 10px;
            border: none;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 15px;
            cursor: pointer;
        }
        .card-text {
            font-size: 1rem;
            color: #495057;
            margin-bottom: 10px;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Lista de Empresas</h1>
        <div id="empresas-list" class="row">
            <!-- Aquí se insertarán las empresas -->
        </div>
    </div>

    <!-- Modal para mostrar detalles de la empresa -->
    <div class="modal fade" id="empresaModal" tabindex="-1" role="dialog" aria-labelledby="empresaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="empresaModalLabel">Detalles de la Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="empresa-details">
                    <!-- Aquí se mostrarán los detalles de la empresa -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar ofertas de trabajo de la empresa -->
    <div class="modal fade" id="ofertasModal" tabindex="-1" role="dialog" aria-labelledby="ofertasModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ofertasModalLabel">Ofertas de Trabajo de la Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="ofertas-details">
                    <!-- Aquí se mostrarán las ofertas de trabajo de la empresa -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Función para cargar los detalles de la empresa seleccionada
            function cargarDetallesEmpresa(numDocumento) {
                $.ajax({
                    url: '/api/empresa',
                    method: 'GET',
                    data: {
                        numDocumento: numDocumento
                    },
                    success: function(data) {
                        let detallesEmpresa = $('#empresa-details');
                        detallesEmpresa.empty();
                        detallesEmpresa.append(`
                            <p><strong>Nombre Comercial:</strong> ${data.nombreComercialEmpresa}</p>
                            <p><strong>Nombre Legal:</strong> ${data.nombreLegalEmpresa}</p>
                            <p><strong>Rubro:</strong> ${data.rubro}</p>
                            <p><strong>Email:</strong> ${data.emailEmpresa}</p>
                            <p><strong>Sitio Web:</strong> <a href="${data.sitioWeb}" target="_blank">${data.sitioWeb}</a></p>
                            <p><strong>Descripción:</strong> ${data.descripcion}</p>
                            <p><strong>Dirección:</strong> ${data.direccion.direccion}, ${data.direccion.detalleDireccion}, ${data.direccion.municipio.nombreMunicipio}, ${data.direccion.municipio.departamento.nombreDepartamento}, ${data.direccion.municipio.departamento.pais.nombrePais}</p>
                            ${data.documento_entidad.telefonos.length > 0 ? `<p><strong>Teléfono:</strong> ${data.documento_entidad.telefonos[0].numTelefono}</p>` : `<p><strong>Teléfono:</strong> No disponible</p>`}
                        `);
                        $('#empresaModal').modal('show');
                    },
                    error: function(error) {
                        console.log('Error:', error);
                        alert('Error al cargar los detalles de la empresa. Por favor, inténtelo de nuevo.');
                    }
                });
            }

            // Función para cargar las ofertas de trabajo de la empresa seleccionada
            function cargarOfertasEmpresa(nombreEmpresa) {
                $.ajax({
                    url: '/api/empresa/ofertas_trabajo',
                    method: 'GET',
                    data: {
                        nombreEmpresa: nombreEmpresa
                    },
                    success: function(data) {
                        let ofertasEmpresa = $('#ofertas-details');
                        ofertasEmpresa.empty();
                        data.forEach(function(ofertas) {
                            ofertas.forEach(function(oferta) {
                                ofertasEmpresa.append(`
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">${oferta.perfil_puesto.nombrePuesto}</h5>
                                            <p class="card-text"><strong>Descripción:</strong> ${oferta.descripcion}</p>
                                            <p class="card-text"><strong>Estado:</strong> ${oferta.estado_oferta.nombreEstado}</p>
                                        </div>
                                    </div>
                                `);
                            });
                        });
                        $('#ofertasModal').modal('show');
                    },
                    error: function(error) {
                        console.log('Error:', error);
                        alert('Error al cargar las ofertas de trabajo de la empresa. Por favor, inténtelo de nuevo.');
                    }
                });
            }

            // Cargar la lista de empresas al cargar la página
            $.ajax({
                url: '/api/empresas',
                method: 'GET',
                success: function(data) {
                    let empresasList = $('#empresas-list');
                    data.forEach(function(empresa) {
                        empresasList.append(`
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title" data-num-documento="${empresa.numDocumento}">${empresa.nombreComercialEmpresa}</h5>
                                        <p class="card-text" data-nom-empresa="${empresa.nombreLegalEmpresa}><strong>Nombre Legal:</strong> ${empresa.nombreLegalEmpresa}</p>
                                        <p class="card-text"><strong>Rubro:</strong> ${empresa.rubro}</p>
                                        <p class="card-text"><strong>Email:</strong> ${empresa.emailEmpresa}</p>
                                        <p class="card-text"><strong>Sitio Web:</strong> ${empresa.sitioWeb}</p>
                                        <p class="card-text"><strong>Descripción:</strong> ${empresa.descripcion}</p>
                                        <button class="btn btn-primary ver-detalle-btn" data-num-documento="${empresa.numDocumento}">Ver Detalles de la Empresa</button>
                                        <button class="btn btn-success ver-ofertas-btn" data-nom-empresa="${empresa.nombreLegalEmpresa}">Ver Ofertas laborales de la Empresa</button>
                                    </div>
                                </div>
                            </div>
                        `);
                    });

                    // Manejar clic en el botón de ver detalles de la empresa
                     $('.ver-detalle-btn').click(function() {
                        let numDocumento = $(this).data('num-documento');
                        cargarDetallesEmpresa(numDocumento);
                    });
                    // Manejar clic en el botón de ver ofertas
                    $('.ver-ofertas-btn').click(function() {
                        let nomEmpresa = $(this).data('nom-empresa');
                        cargarOfertasEmpresa(nomEmpresa);
                    });
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });
    </script>
</body>
</html>
