<?php
//session_start();
require('../../negocio/GArchivo/NArchivo.php');
require('headerA.php');
if(!isset($_SESSION['user'])){header('Location:../../index.php');}
$usuario=$_SESSION['user'];
$v_carpeta=$_GET['v_carpeta'];
$_SESSION['n_carpeta']=$v_carpeta;

$n_carpeta=$_SESSION['n_carpeta'];

?>


        <div class="content">

            <div class="animated fadeIn">

                
                   
                    <?php $listado = new NArchivo();
						          $resultado=$listado->getListaArchivos($usuario,$v_carpeta);?>

                     
                        
                        
                        <!--?php  include('../GArchivo/p_subir_Archivo.php'); ?-->
                        
                        
                        <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Subir Fotografia</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content"> 
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Subir Fotografia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form form enctype="multipart/form-data" method="post" action="../../negocio/GArchivo/NArchivo.php" id="form_datos">
                                  <div class="form-group">
                                      <label for="fichero">Seleccione su imagen</label>
                                      <input name="fichero" type="file" id="fichero" name="fichero" >
                                   </div>
                                    
                                  <div class="form-group">
                                    <label for="message-text" class="col-form-label">Descripción</label>
                                    <textarea class="form-control" name="descripcion" placeholder="descripcion" rows="3" id="message-text"></textarea>
                                  </div>
                                   <div class="form-group">
                                    <label for="message-text" class="col-form-label">Precio</label>
                                      <input type="number" class="form-control" name="precio" placeholder="precio" rows="3" id="message-text">
                                  </div>

                                  <div class="modal-footer">  
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>  
                                    <button type="submit" name="subir" class="btn btn-success">Confirmar</button>
                                  </div>
                                </form>
                              </div>

                            </div>
                          </div>
                        </div>

                        
                         <div class="row">
                             <?php
                                     if(!empty($resultado) AND count($resultado) > 0){
                                        foreach ($resultado as $key => $fila) {

                                         
                              ?>

                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                           
                              <div class="card" style="width: 18rem;">
                                <img src="<?php echo '../../Directorios/'.$v_carpeta.'/'.$fila[1]; ?>"       height="150" width="150" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">
                                    <a class="h5 card-title" href="javascript:ver('<?php echo $fila[1]; ?>','<?php echo $v_carpeta; ?>','<?php echo $fila[5]; ?>');"><?php echo $fila[1]; ?>
                                    </a>
                                  </h5>
                                  <p class="card-text"><?php echo $fila[2]; ?></p>
                                </div>  
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><?php echo "Tamaño: ".$fila[3]; ?></li>
                                  <li class="list-group-item"><?php echo "Precio: ".$fila[7]." Bs"; ?></li>                                  
                                </ul>                             
                                <div class="card-body">
                                   <Button class=" badge badge-success card-link" data-toggle="tooltip" data-placement="top" title="Editar el archivo" onclick="cargarEdicion('<?php echo $fila[1]; ?>','<?php echo $v_carpeta; ?>','<?php echo $usuario; ?>','<?php echo $fila[5]; ?>');" >Modificar</Button>
                                    <Button class="card-link  badge badge-danger " data-toggle="tooltip" data-placement="top" title="Eliminar el archivo" onclick="cargarEliminacion('<?php echo $fila[1]; ?>','<?php echo $v_carpeta; ?>','<?php echo $usuario; ?>','<?php echo $fila[5]; ?>');">Eliminar</Button>
                                          <?php  echo '<a  class="card-link btn  badge badge-warning" data-toggle="tooltip" data-placement="top" title="Descargar el archivo" href="../../negocio/GArchivo/NArchivo.php?n_archivo='.$fila[1].'&n_carpeta='.$v_carpeta.'&n_usuario='.$usuario.'&descargar=true'.'"> Descarga</a>';?>
                                   
                                </div>
                              </div>
                            
                      </div>
                          <?php }} ?>               

                        
                  

                </div>

            </div>

        </div>

    </div>


<script>

function cargarEdicion(v_archivo,v_carpeta,v_usuario,v_extension){
          var n_archivo=v_archivo;
          var n_carpeta=v_carpeta;
          var n_usuario=v_usuario;
          var n_extension=v_extension;
          var nuevo_nombre="";
          var nueva_descripcion="";
          var nuevo_precio="";
         
          Swal.mixin({
            input: 'text',
            confirmButtonText: 'Siguiente &rarr;',
            showCancelButton: true,
            progressSteps: ['1', '2','3']
          }).queue([
            {title: '<p class="font-weight-bold h5">Ingrese el nuevo nombre</p>',text: '' },
            {title: '<p class="font-weight-bold h5">Ingrese la nueva descripcion</p>',text: '' },
            {title: '<p class="font-weight-bold h5">Ingrese El nuevo precio del producto</p>',text: '' }
          ]).then((result) => {
            if (result.value) {
                const a=JSON.stringify(result.value);
                var datos= JSON.parse(a);
                nuevo_nombre=datos[0];
                nueva_descripcion=datos[1];
                nuevo_precio=datos[2];
                mi_ajax(n_archivo,n_carpeta,n_usuario,n_extension,nuevo_nombre,nueva_descripcion,nuevo_precio);

            }
          })
          //url: '../php/edicionArchivos.php',  url: '../php/pruebas.php',
}

function mi_ajax(n_archivo,n_carpeta,n_usuario,n_extension,nuevo_nombre,nueva_descripcion,nuevo_precio){
                $.ajax({
                data: { "n_archivo" : n_archivo,"n_carpeta" : n_carpeta, "n_usuario":n_usuario,"n_extension":n_extension,"nuevo_nombre":nuevo_nombre,"nueva_descripcion":nueva_descripcion, "nuevo_precio":nuevo_precio},
                async: false,
                url: '../../negocio/GArchivo/NArchivo.php',
                type: 'POST',
                datatype: 'json',

                success: function(response) {
                    alert(response);
                    location.reload();
                  //procesar(response);

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

function cargarEliminacion(v_archivo,v_carpeta,v_usuario,v_extension){
          var n_archivo=v_archivo;
          var n_carpeta=v_carpeta;
          var n_usuario=v_usuario;
          var n_extension=v_extension;

                $.ajax({
                data: { "n_archivo" : n_archivo,"n_carpeta" : n_carpeta, "n_usuario":n_usuario,"n_extension":n_extension},
                async: true,
                url: '../../negocio/GArchivo/NArchivo.php',
                type: 'POST',
                datatype: 'json',

                success: function(response) {
                    alert(response);
                    location.reload();
                  //procesar2(response);

                },
                error: function() {
                    alert('Error al obtener informacion');
                }

                });

}

function procesar2(datos) {
    Swal.fire({ html: '<p class="font-weight-bold h6">' + datos + '</p>'});

}

</script>


<script>

function ver(v_archivo,v_carpeta,v_extension){
          var n_archivo=v_archivo;
          var n_carpeta=v_carpeta;
          var n_extension=v_extension;
          var imagen='../../Directorios/'+n_carpeta+'/'+n_archivo;
          if(n_extension=="jpeg" || n_extension=="gif"|| n_extension=="png"){
              Swal.fire({ html: "<img src='"+imagen+"' style='width:450px;'>" });
          }else{
             Swal.fire({ html: '<p class="font-weight-bold h6">' + 'No es un formato de vista' + '</p>'});
          }


}
</script>


    <?php require('footerA.php'); ?>

</body>
</html>
