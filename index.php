<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Login Form</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 text-center">Inicie sesión</h3>
                </div>
                <div class="card-body">
                    <form class="form" role="form" action="validar.php" method="post">
                        <div class="mb-3">
                            <label for="email">Correo</label>
                            <input type="email" class="form-control" id="email" name="email" required="">
                        </div>
                        <div class="mb-3">
                            <label for="password">Contrseña</label>
                            <input type="password" class="form-control" id="password" name="password" required="">
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" name="entrar" class="btn btn-primary btn-lg btn-block">Entrar</button>
                        </div>
                    </form>
                </div>
				<div class="card-footer text-end">
                    <p class="mb-0">¿No tienes una cuenta? <a href="./registrarse.php" id="showRegister">Regístrate aquí</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>