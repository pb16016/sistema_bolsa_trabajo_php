<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Bolsa de Trabajo</title>
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
            padding: 40px;
            background-color: #007bff;
            border-radius: 20px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card-green {
            background-color: #28a745; /* Verde de Bootstrap */
            color: white;
        }

        .card-yellow {
            background-color: #ffc107; /* Amarillo de Bootstrap */
            color: black;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Sistema de Bolsa de Trabajo (en construcción)</div>
        <span id="email" style="display: none;">{{ $email }}</span>
        <div class="row">
            <div class="col-lg-6">
                <div class="card" onclick="redirectToPersonaView()">
                    <h2>Datos de Persona</h2>
                    <p>Administra tu información registrada en el sistema.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card" onclick="window.location.href='/empresas'">
                    <h2>Empresas</h2>
                    <p>Empresas en el sistema.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card" onclick="window.location.href='/ofertas-laborales'">
                    <h2>Ofertas Laborales</h2>
                    <p>Explora y aplica a las ofertas laborales disponibles en el sistema.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card" onclick="redirectToCvs()">
                    <h2>CVs</h2>
                    <p>Accede a tus currículums vitae registrados.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-green" onclick="window.location.href='/change-password'">
                    <h2>Cambio de Password</h2>
                    <p>Administra tu password de usuario en el sistema.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-yellow" onclick="redirectTologout()">
                    <h2>Cerrar Sesión</h2>
                    <p>Cerrar Sesión activa en el sistema.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectToPersonaView() {
            var emailUser = document.getElementById('email').textContent;
            var url = 'http://bdd-frontend.up.railway.app/persona-view?email=' + encodeURIComponent(emailUser);
            window.location.href = url;
        }

        function redirectToCvs() {
            var emailUser = document.getElementById('email').textContent;
            var url = 'http://bdd-frontend.up.railway.app/cvs?email=' + encodeURIComponent(emailUser);
            window.location.href = url;
        }
        function redirectTologout() {
            var url = 'http://bdd-frontend.up.railway.app/login';
            window.location.href = url;
        }
    </script>
</body>
</html>
