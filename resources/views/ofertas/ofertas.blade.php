<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas Laborales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Ofertas Laborales</h1>
        <div id="ofertas-list" class="row">
            <!-- Aquí se insertarán las ofertas laborales -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/ofertas_laborales',
                method: 'GET',
                success: function(data) {
                    let ofertasList = $('#ofertas-list');
                    data.forEach(function(oferta) {
                        ofertasList.append(`
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">${oferta.titulo}</h5>
                                        <p class="card-text">${oferta.descripcion}</p>
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
</body>
</html>
