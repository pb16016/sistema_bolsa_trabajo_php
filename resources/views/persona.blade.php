<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            margin-top: 100px;
        }
        .card {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
        }
        .card-title {
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-login {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card">
            <h2 class="card-title">Iniciar Sesión</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label for="login">Correo Electrónico o Nombre de Usuario</label>
                    <input type="text" class="form-control" id="login" name="login" value="pb16016@ues.edu.sv" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" value="123456" required>
                </div>
                <button type="submit" class="btn btn-primary btn-login">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                event.preventDefault();

                var loginData = {
                    login: $('#login').val(),
                    password: $('#password').val()
                };

                $.ajax({
                    url: '/login',
                    method: 'POST',
                    data: loginData,
                    success: function(response) {
                        alert(response.message);
                        // Redireccionar a la página principal o a otra página después del inicio de sesión
                        window.location.href = '/';
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.error;
                        alert(errorMessage);
                    }
                });
            });
        });
    </script>
</body>
</html>
