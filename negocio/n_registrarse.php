<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <style>
      body {
        background-image: url("iconos/fondo.jpg");
        background-attachment: fixed;
      }

      .colorcito{
        opacity: 0.8;
        filter: alpha(opacity=70);
        -moz-opacity: 0.8;
        
        -khtml-opacity: 0.8;
      }
    </style>

    <title>Bienvenido Juridico</title>
  </head>
  <body>
    


<div class="container">
  <div class="colorcito  row d-flex  justify-content-center m-0 p-0">
    <div class="bg-warning col col-sm-12 col-md-12 col-lg-5 col-xl-5 p-3">
      <h4 class="text-center display pb-2">Ingrese los datos </h4>
      <form  id="form_datos" method="POST" action="validarR.php" >
        <div class="form-group">
          <label for="usuario">Usuario</label>
          <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
        </div>
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
          <label for="ap_paterno">Apellido Paterno</label>
          <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" placeholder="ap_paterno">
        </div>
        <div class="form-group">
          <label for="ap_materno">Apellido Materno</label>
          <input type="text" class="form-control" id="ap_materno" name="ap_materno" placeholder="ap_materno">
        </div>

        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="mail" class="form-control left" id="email" name="email" placeholder="Email">
        </div>


        <div class="form-group">
          <label for="gridRadios1">Sexo</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Masculino" checked>
            <label  for="gridRadios1">Masculino</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Femenino">
            <label  for="gridRadios2">Femenino</label>
          </div>
        </div>

        <div class="form-group">
          <label for="fechanac">Fecha de Nacimiento</label>
          <input type="date" class="form-control" id="fechanac" name="fechanac" placeholder="fechanac">
        </div>

        <div class="form-group">
          <label for="titulo">Titulo Academico</label>
          <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" required>
        </div>

        <div class="form-group">
          <label for="inst_academica">Institución Academica</label>
          <input type="text" class="form-control" id="inst_academica" name="inst_academica" placeholder="inst_academica" required>
        </div>
       

        <div class="form-group">
          <label for="codigo">contraseña</label>
          <input type="password" class="form-control" id="codigo" name="codigo" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="confircodigo">repita la contraseña</label>
          <input type="password" class="form-control left" id="codigo1" name="codigo1" placeholder="Password">
        </div>
        <button  class="btn btn-danger" id="registrar" type="submit" name="registrar">Registrar</button>
      </form>
    </div>
  </div>
</div>




</body>
</html>
