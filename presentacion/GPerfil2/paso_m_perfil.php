<?php session_start();if(!isset($_SESSION['user'])){header('Location:../../index.php');}require('headerA.php');?>
  
  <div class="container">
    <div class="row justify-content-center align-items-center minh-100">
        <p class="display h4">Registro exitoso!</p>
        <a class=" btn btn-lg btn-danger "  href="p_modificar_perfil_form.php">Ir al formulario de modificaciones</a>
    </div>
  </div>
 
     <?php require('footerA.php'); ?>
  </body>
</html>