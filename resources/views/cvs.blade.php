<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CVs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 40px;
            text-align: center;
            color: #007bff;
        }

        .card {
            padding: 20px;
            background-color: #007bff;
            border-radius: 20px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card p {
            font-size: 20px;
            margin: 0;
        }

        .row {
            margin-bottom: 40px;
        }

        .info {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #007bff;
        }

        .section-content {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .subtitle {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            color: #007bff;
        }

        .sub-content {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .cv-container {
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">CVs</div>
        <span id="email" style="display: none;">{{ $email }}</span>
        <div class="info" id="cvInfo">
            <p>Cargando información...</p>
        </div>
    </div>

    <script>
        function redirectToCvs() {
            var emailUser = document.getElementById('email').textContent;
            var url = 'https://bdd-frontend.up.railway.app/api/persona/by_email?emailPersona=' + encodeURIComponent(emailUser);
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.hasOwnProperty('message')) {
                        var cvInfo = document.getElementById('cvInfo');
                        cvInfo.innerHTML = '<p>' + data.message + '</p>';
                    } else {
                        var urlCvs = 'https://bdd-frontend.up.railway.app/api/persona/cvs?numDocumento=' + encodeURIComponent(data.numDocumento);
                        fetch(urlCvs)
                            .then(response => response.json())
                            .then(cvs => {
                                var cvInfo = document.getElementById('cvInfo');
                                cvInfo.innerHTML = '';
                                
                                if (cvs.length > 0) {
                                    cvs.forEach(cv => {
                                        var cvHtml = `
                                            <div class="cv-container">
                                                <div class="section">
                                                    <h2 class="section-title">Currículum Vitae</h2>
                                                    <div class="section-content">
                                                        <div class="subtitle">Descripción:</div>
                                                        <div class="sub-content">${cv.descripcion}</div>
                                                    </div>
                                                    <div class="section-content">
                                                        <div class="subtitle">Fecha de Publicación:</div>
                                                        <div class="sub-content">${cv.fechaPublicacion}</div>
                                                    </div>
                                                    <div class="section-content">
                                                        <div class="subtitle">Experiencias Laborales:</div>
                                        `;
                                        
                                        cv.experiencias_laborales.forEach(experiencia => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${experiencia.nombreOrganizacion} (${experiencia.periodoInicio} - ${experiencia.periodoFin}): ${experiencia.funcionesDesempeñadas}
                                                </div>
                                            `;
                                        });

                                        cvHtml += `
                                                    <div class="subtitle">Certificaciones:</div>
                                        `;
                                        
                                        cv.certificaciones.forEach(certificacion => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${certificacion.nombreCertificacion} (${certificacion.fechaCertificacion}): ${certificacion.descripcion}
                                                </div>
                                            `;
                                        });

                                        cvHtml += `
                                                    <div class="subtitle">Conocimientos Académicos:</div>
                                        `;
                                        
                                        cv.conocimientos_academicos.forEach(conocimiento => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${conocimiento.tituloAcademico} (${conocimiento.fechaInicio} - ${conocimiento.fechaFin}): ${conocimiento.descripcion}
                                                </div>
                                            `;
                                        });

                                        cvHtml += `
                                                    <div class="subtitle">Habilidades Técnicas:</div>
                                        `;
                                        
                                        cv.habilidades_tecnicas.forEach(habilidad => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${habilidad.nombreHabilidad}: ${habilidad.descripcion}
                                                </div>
                                            `;
                                        });

                                        cvHtml += `
                                                    <div class="subtitle">Habilidades Idiomas:</div>
                                        `;
                                        
                                        cv.habilidades_idiomas.forEach(idioma => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${idioma.idioma}: Escritura(${idioma.nivelEscritura}) - Lectura(${idioma.nivelLectura}) - Conversación(${idioma.nivelConversacion}) - Escucha(${idioma.nivelEscucha}): ${idioma.categoria_nivel.descripcion}
                                                </div>
                                            `;
                                        });

                                        cvHtml += `
                                            <div class="subtitle">Recomendaciones:</div>
                                        `;
                                        cv.recomendaciones.forEach(recomendacion => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${recomendacion.tipoRecomendacion}: ${recomendacion.nombresRecomendador} ${recomendacion.apellidosRecomendador} (${recomendacion.cargoRecomendador}, ${recomendacion.parentescoRecomendador}) - Teléfono: ${recomendacion.telefonoContacto}, Email: ${recomendacion.emailContacto}
                                                </div>
                                            `;
                                        });


                                        cvHtml += `
                                            <div class="subtitle">Logros Laborales:</div>
                                        `;
                                        cv.logros_labores.forEach(logro => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${logro.nombreLogroLabor} (${logro.fechaRealizacion}): ${logro.descripcion}
                                                </div>
                                            `;
                                        });

                                        cvHtml += `
                                            <div class="subtitle">Resultados de Pruebas:</div>
                                        `;
                                        cv.resultados_pruebas.forEach(prueba => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${prueba.nombrePrueba} (${prueba.tipoPrueba}, ${prueba.fechaRealizacion}): ${prueba.resultadoObtenido} - <a href="${prueba.urlResultadoPrueba}" target="_blank">Ver Resultado</a>
                                                </div>
                                            `;
                                        });

                                        cvHtml += `
                                            <div class="subtitle">Participación en Eventos:</div>
                                        `;
                                        cv.participacion_eventos.forEach(evento => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${evento.nombreEvento} (${evento.tipoEvento}) en ${evento.lugarEvento}, ${evento.paisEvento} (${evento.fechaInicio} - ${evento.fechaFin}): ${evento.descripcion}
                                                </div>
                                            `;
                                        });

                                        cvHtml += `
                                            <div class="subtitle">Artículos y Libros:</div>
                                        `;
                                        cv.articulos_libros.forEach(articulo => {
                                            cvHtml += `
                                                <div class="sub-content">
                                                    - ${articulo.tituloPublicacion} (${articulo.tipoPublicacion}, ${articulo.fechaPublicacion}): ${articulo.descripcion} - ISBN: ${articulo.ISBN}
                                                </div>
                                            `;
                                        });



                                        cvHtml += `
                                            </div>
                                        </div>
                                        `;
                                        
                                        cvInfo.innerHTML += cvHtml;
                                    });
                                } else {
                                    cvInfo.innerHTML = '<p>No se encontraron CVs para este usuario.</p>';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                var cvInfo = document.getElementById('cvInfo');
                                cvInfo.innerHTML = '<p>Ocurrió un error al cargar los CVs.</p>';
                            });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    var cvInfo = document.getElementById('cvInfo');
                    cvInfo.innerHTML = '<p>Ocurrió un error al cargar la información.</p>';
                });
        }
        redirectToCvs();
    </script>
</body>
</html>
