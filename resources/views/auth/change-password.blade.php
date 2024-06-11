<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
            padding: 10px 20px;
        }

        .alert {
            margin-top: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Cambiar Contraseña</div>
        <form id="changePasswordForm">
            <div class="form-group">
                <label for="login">Correo Electrónico o Usuario</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="current_password">Contraseña Actual</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nueva Contraseña</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
                <small class="form-text text-muted">
                    La contraseña debe tener entre 8 y 15 caracteres, empezar con una letra, contener al menos una letra mayúscula, un símbolo especial y un número.
                </small>
            </div>
            <div class="form-group">
                <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
        </form>
        <div id="alertContainer"></div>
    </div>

    <script>
        document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(this);
            const jsonData = Object.fromEntries(formData.entries());

            fetch('https://bdd-frontend.up.railway.app/api/change-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData)
            })
            .then(response => response.json())
            .then(data => {
                const alertContainer = document.getElementById('alertContainer');
                alertContainer.innerHTML = '';

                if (data.error || data.errors) {
                    const errors = data.error ? [data.error] : Object.values(data.errors).flat();
                    errors.forEach(error => {
                        const alert = document.createElement('div');
                        alert.className = 'alert alert-danger';
                        alert.innerText = error;
                        alertContainer.appendChild(alert);
                    });
                } else {
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success';
                    alert.innerText = data.message;
                    alertContainer.appendChild(alert);

                    // Limpiar los campos del formulario
                    document.getElementById('changePasswordForm').reset();
                }
            })
            .catch(error => {
                const alertContainer = document.getElementById('alertContainer');
                alertContainer.innerHTML = '<div class="alert alert-danger">Ocurrió un error al cambiar la contraseña. Inténtelo de nuevo.</div>';
            });
        });
    </script>
</body>
</html>
