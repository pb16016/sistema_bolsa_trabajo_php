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
        .btn-login, .btn-register {
            width: 100%;
        }
        .btn-reset-password {
            width: 100%;
            color: #007bff;
            background-color: transparent;
            border: none;
            text-align: center;
            padding: 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card">
            <h2 class="card-title">Iniciar Sesión</h2>
            <form id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="login">Correo Electrónico o Nombre de Usuario</label>
                    <input type="text" class="form-control" id="login" name="login" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-login">Iniciar Sesión</button>
            </form>
            <br/>
            <label>__________________________________________</label>
            <label>Username de prueba: TestUser</label>
            <label>Contraseña simple de prueba: Password1*</label>
            <label>Email para usuario de prueba: kyrna.quintanilla@ues.edu.sv</label>
            <br/>
            <div class="text-center">
                <button class="btn btn-link btn-reset-password" data-toggle="modal" data-target="#resetPasswordModal">¿Olvidaste tu contraseña?</button>
                <br/>
                <br/>
                <p>¿Aún no tienes una cuenta? <a href="/registro" class="btn-register btn btn-success">Registrarse</a></p>
            </div>
        </div>
    </div>

    <!-- Modal Restablecer Contraseña -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">Restablecer Contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="resetPasswordForm">
                        <div class="form-group">
                            <label for="resetEmail">Correo Electrónico</label>
                            <input type="email" class="form-control" id="resetEmail" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-reset">Restablecer Contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                event.preventDefault();

                var loginData = {
                    login: $('#login').val(),
                    password: $('#password').val()
                };

                $.ajax({
                    url: '/api/login',
                    method: 'POST',
                    data: loginData,
                    success: function(response) {
                        var emailUser = response.data.email;
                        alert(response.message);
                        // Redireccionar a la página principal o a otra página después del inicio de sesión
                        window.location.href = 'https://bdd-frontend.up.railway.app/main?email=' + encodeURIComponent(emailUser); // Redirecciona a la vista de persona
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.error;
                        alert(errorMessage);
                    }
                });
            });


            $('#resetPasswordForm').submit(function(event) {
                event.preventDefault();

                var resetData = {
                    email: $('#resetEmail').val(),
                };

                $.ajax({
                    url: '/api/forgot-password',
                    method: 'POST',
                    data: resetData,
                    success: function(response) {
                        alert(response.message);
                        $('#resetPasswordModal').modal('hide');
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
