<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    

   
    </style>

    <title>Prueba Profel</title>
  </head>
  <body class="">
<div class="container">
  <div class="  row d-flex  justify-content-center m-0 p-2">
    <div class=" col col-sm-12 col-md-12 col-lg-5 col-xl-5 p-3 mx-4">
      <h4 class="text-center display pb-2">Rellene los datos</h4>
        <div class="card mt-3" id="registerForm">
          <div class="card-body">
              <form id="registerForm" action="validarR.php" method="POST">
                  <div class="mb-3">
                      <label for="registerEmail" class="form-label">Correo electrónico:</label>
                      <input type="email" class="form-control" id="registerEmail" name="registerEmail" required>
                  </div>
                  <div class="mb-3">
                      <label for="registerPassword" class="form-label">Contraseña:</label>
                      <input type="password" class="form-control" id="registerPassword" name="registerPassword" required>
                  </div>
                  <button type="submit" class="btn btn-success">Registrarse</button>
              </form>
          </div>
          <div class="card-footer">
              <p class="mb-0">¿Ya tienes una cuenta? <a href="../test1" id="showLogin">Inicia sesión aquí</a>.</p>
          </div>
        </div>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
