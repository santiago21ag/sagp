<?php 
require('../../negocio/GDirectorio/NDirectorio.php');
//session_start();
require('headerD.php');
if(!isset($_SESSION['user'])){header('Location:../../index.php');}
$usuario=$_SESSION['user'];

?>

        <div class="content">
            <div class="animated fadeIn">
                <?php include('p_crear_directorio_a.php'); ?>
               <?php $listado= new NDirectorio();
                      $resultado = $listado->getListaDirectorios($usuario);?>

                    <div class="row">
                        
                          <?php
                                      
                            if(!empty($resultado) AND count($resultado) > 0){
                            foreach ($resultado as $key => $fila) {
                          ?> 
                        <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-4">
                            <div class="card text-center "> 
                            <div class="card-header h4 bg-secondary text-white">
                               <?php echo $fila[1];?>
                            </div>                               
                                <div class="card-body">
                                  
                                  <p class="card-text"><?php echo $fila[2];?></p>
                                  <a class="btn btn-success" href="../GArchivo/listar_archivo.php?v_carpeta=<?php echo $fila[1];?>">Abrir</a>

                                  <button  class="btn btn-warning" onclick="cargarEdicion('<?php echo $fila[1]; ?>','<?php echo $fila[2]; ?>','<?php echo $usuario; ?>');">Modificar</button>
                                  <button  class="btn btn-danger" onclick="cargarEliminacion('<?php echo $fila[1]; ?>','<?php echo $fila[2]; ?>','<?php echo $usuario; ?>');">Eliminar</button>

                                </div>
                               
                              </div>

                        </div>  

                         <?php
                             }         
                           }
                          ?>     
                                              
                                              
                    </div>

            </div>

        </div>

    </div>



<script>
function cargarEdicion(v_carpeta,v_descripcion,v_usuario){
          var n_carpeta=v_carpeta;
          var n_descripcion=v_descripcion;
          var n_usuario=v_usuario;

          var nuevo_nombre="";
          var nueva_descripcion="";
          
          Swal.mixin({
            input: 'text',
            confirmButtonText: 'Siguiente &rarr;',
            showCancelButton: true,
            progressSteps: ['1', '2']
          }).queue([
            {title: '<p class="font-weight-bold h5">Ingrese el nuevo nombre</p>',text: '' },
            {title: '<p class="font-weight-bold h5">Ingrese la nueva descripcion</p>',text: '' }
          ]).then((result) => {
            if (result.value) {
                const a=JSON.stringify(result.value);
                var datos= JSON.parse(a);
                nuevo_nombre=datos[0];
                nueva_descripcion=datos[1];

                
                mi_ajax(n_carpeta,n_descripcion,n_usuario,nuevo_nombre,nueva_descripcion);

            }
          })
          //url: '../php/edicionArchivos.php',  url: '../php/pruebas.php',
}

function mi_ajax(n_carpeta,n_descripcion,n_usuario,nuevo_nombre,nueva_descripcion){
                $.ajax({
                data: { "n_usuario":n_usuario,"n_carpeta" : n_carpeta,"n_descripcion" : n_descripcion, "nuevo_nombre":nuevo_nombre,"nueva_descripcion":nueva_descripcion},
                async: false,
                //cache: false,
                url: "../../negocio/GDirectorio/NDirectorio.php",
                type: "POST",
                datatype: "json",                

               success: function(response) {
                    alert(response);
                    location.reload();
                 // procesar2(response);

                },
                error: function() {
                    alert('Error al obtener informacion');
                }

                });


}

function procesar(datos) {
    Swal.fire({ html: '<p class="font-weight-bold h6">' + datos + '</p>'});
}

</script>


<script>

function cargarEliminacion(v_carpeta,v_descripcion,v_usuario){
            var n_carpeta=v_carpeta;
            var n_descripcion=v_descripcion;
            var n_usuario=v_usuario;
            var bandera="true";

                $.ajax({
                data: { "true":bandera,"n_usuario":n_usuario, "n_carpeta" : n_carpeta,"n_descripcion" : n_descripcion },
                async: false,
                url: '../../negocio/GDirectorio/NDirectorio.php',
                type: 'POST',
                datatype: 'json',

                success: function(response) {
                    alert(response);
                    location.reload();
                 // procesar2(response);

                },
                error: function() {
                    alert('Error al obtener informacion');
                }

                });

}

function procesar2(datos) {
    //Swal.fire({ html:'<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>'});
    Swal.fire({ html: '<p class="font-weight-bold h6">' + datos + '</p>'});
}

</script>

<?php require('footerD.php'); ?>

</body>
</html>
