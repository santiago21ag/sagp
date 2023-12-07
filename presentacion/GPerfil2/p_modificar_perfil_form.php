<?php session_start();
if(!isset($_SESSION['user'])){
    header('Location:../../index.php');
    
}
$usuario=$_SESSION['user'];

require('../../negocio/GPerfil/NPerfil.php');
require('headerA.php');?>



        <div class="content">


            <div class="animated fadeIn">

                <div class="container">
                    <?php 

                      $modificar=new NPerfil();
                      $fila1 = $modificar->getPerfilItemN($usuario);
                       if(count($fila1[0])==9){                        
                    ?>

                    <div class=" row d-flex  justify-content-center m-0 p-0">
                        <div class="colorcito bg-info col col-sm-12 col-md-12 col-lg-5 col-xl-5 p-3">
                            <h4 class="text-center display p-3">Modificar los datos</h4>
                            <form   id="form_datos" method="POST" action="../../negocio/GPerfil/NPerfil.php" >
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario"  value="<?php echo $fila1[0][1];?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nit">Nit</label>
                                    <input type="number" class="form-control" id="nit" name="nit"  value="<?php echo $fila1[0][2];?>" placeholder="NIT" required>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"  value="<?php echo $fila1[0][3];?>" >
                                </div>
                                <div class="form-group">
                                    <label for="ap_paterno">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" placeholder="ap_paterno" value="<?php echo $fila1[0][4];?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="ap_materno">Apellido Materno</label>
                                    <input type="text" class="form-control" id="ap_materno" name="ap_materno" placeholder="ap_materno" value="<?php echo $fila1[0][5];?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="mail" class="form-control left" id="email" name="email" placeholder="Email" value="<?php echo $fila1[0][6];?>" required>
                                </div>                                                    
                                

                                <div class="form-group pt-2">
                                    <label for="telefono" class="text-dark">Telefono</label>
                                    <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $fila1[0][7];?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="codigo">contraseña</label>
                                    <input type="password" class="form-control" id="codigo" name="codigo"  value="<?php echo $fila1[0][8];?>" required>
                                </div>
                                
                                <div class="form-group">
                                    
                                    <input id="idPersona" name="idPersona" type="hidden" value="<?php echo $fila1[0][0]; ?>">
                                </div>


                                <div class="d-flex justify-content-center">
                                    <button  class="btn btn-success text-center" id="modificar" onclick="" name="modificar">Modificar</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <?php  }else{  ?>


                    <div class=" row d-flex  justify-content-center m-0 p-0">
                        <div class="colorcito bg-info col col-sm-12 col-md-12 col-lg-5 col-xl-5 p-3">
                            <h4 class="text-center display p-3">Modificar los datos</h4>
                            <form   id="form_datos" method="POST" action="../../negocio/GPerfil/NPerfil.php" >
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario"  value="<?php echo $fila1[0][1];?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nit">Nit</label>
                                    <input type="number" class="form-control" id="nit" name="nit"  value="<?php echo $fila1[0][2];?>" placeholder="NIT" required>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"  value="<?php echo $fila1[0][3];?>" >
                                </div>
                               
                                <div class="form-group">
                                    <label for="ap_materno">Direccion</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo $fila1[0][4];?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="mail" class="form-control left" id="email" name="email" placeholder="Email" value="<?php echo $fila1[0][5];?>" required>
                                </div>                                                    
                                

                                <div class="form-group pt-2">
                                    <label for="telefono" class="text-dark">Telefono</label>
                                    <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $fila1[0][6];?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="codigo">contraseña</label>
                                    <input type="password" class="form-control" id="codigo" name="codigo"  value="<?php echo $fila1[0][7];?>" required>
                                </div>
                                
                                <div class="form-group">
                                    
                                    <input id="idEstudioF" name="idEstudioF" type="hidden" value="<?php echo $fila1[0][0]; ?>">
                                </div>


                                <div class="d-flex justify-content-center">
                                    <button  class="btn btn-success text-center" id="modificar" onclick="" name="modificar">Modificar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php  }  ?>

                </div>

            </div>

        </div>

 </div>   

<script>
 //document.getElementById('nombre').value=<?php echo fila1[0];?>;
</script>

<?php require('footerA.php'); ?>


</body>
</html>
