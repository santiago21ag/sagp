<?php 
require('../../negocio/GDirectorio/NDirectorio.php');
//session_start();
require('headerD.php');
if(!isset($_SESSION['user'])){header('Location:../../index.php');}
$usuario=$_SESSION['user'];

?>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col col-12">
                    <?php $listado= new NDirectorio();
                      $resultado = $listado->getListaDirectorios($usuario);?>

                      <div class="col-sm-12">  
                        <!--a href="crear_carpeta.php" class="btn btn-success mb-4">Crear Carpeta</a-->
                        
                        <?php include('p_crear_directorio_a.php'); ?>

                        <table id="example1" class="table table-bordered table-hover table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                              <thead>
                                  <tr role="row" class="bg-warning">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Archivo: activar para ordenar la columna descendente" style="width: 219px;">Evento</th>
                                    <th class="hidden-xs hidden-sm sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Descripción: activar para ordenar la columna ascendente" style="width: 312px;">Descripción</th>
                                   
                                    <th class="hidden-xs hidden-sm sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Subidol el:: activar para ordenar la columna ascendente" style="width: 100px;">Creado el:</th>
                                    <th class="hidden-xs hidden-sm sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label=": activar para ordenar la columna ascendente" style="width: 172px;">Gestionar</th>
                                  </tr>
                              </thead>
                              <tbody>

                              <?php
                                      
                                    if(!empty($resultado) AND count($resultado) > 0){
                                    foreach ($resultado as $key => $fila) {
                                     
                                      echo '<tr role="row" class="odd">';
                                      echo  '<td style="width: 250px" class="sorting_1">';
                                      echo  '<a href="../GArchivo/listar_archivo.php?v_carpeta='.$fila[1].'"><img class="rounded" style="width:30px;height:30px;" src="../../estilo/iconos/carpeta1.png"/>'.' '.$fila[1].'</a></td>';
                                      echo '<td class="hidden-xs hidden-sm" style="width: 350px">'.$fila[2].'</td>';                              
                                      
                                      echo '<td style="width: 125px;" class=" hidden-xs hidden-sm"><span style="font-size: 12px;">'.$fila[3].'</span></td>';
                                      echo '<td class="hidden-xs hidden-sm" style="width:140px;">';
                              ?>
                                      <Button class="fa fa-pencil badge badge-warning" data-toggle="tooltip" data-placement="top" title="Editar la carpeta" onclick="cargarEdicion('<?php echo $fila[1]; ?>','<?php echo $fila[2]; ?>','<?php echo $usuario; ?>');" >Editar</Button>

                                      <Button class="fa fa-trash badge badge-danger " data-toggle="tooltip" data-placement="top" title="Eliminar la carpeta" onclick="cargarEliminacion('<?php echo $fila[1]; ?>','<?php echo $fila[2]; ?>','<?php echo $usuario; ?>');">Eliminar</Button>

                              <?php
                                     echo '</td>';
                                     echo '</tr>';
                              }
                            }
                              ?>
                                </tbody>
                          </table>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<script>

async function Estado(v_carpeta,v_descripcion,estado,v_usuario){
  var n_carpeta=v_carpeta;
  var n_descripcion=v_descripcion;
  var n_estado="";
  var n_usuario=v_usuario;

      const inputOptions = new Promise((resolve) => {
      setTimeout(() => {
        resolve({
          'No iniciado': 'No iniciado',
          'En proceso': 'En proceso',
          'Finalizado': 'Finalizado'
        })
      }, 500)
    })

    const { value: color } = await Swal.fire({
      title: 'Seleccione Estado',
      input: 'radio',
      inputOptions: inputOptions,
      inputValidator: (value) => {
        if (!value) {
          return 'Necesita elegir un Estado!'
        }
      }
    })

    if (color) {
      n_estado=color;
      mi_ajax_estado(n_carpeta,n_descripcion,n_estado,n_usuario);
      //Swal.fire({ html: 'Registrado con exito! ' + n_estado + ' '+ n_carpeta})
    }
}


function mi_ajax_estado(n_carpeta,n_descripcion,n_estado,n_usuario){
                $.ajax({
                data: { "n_carpeta" : n_carpeta,"n_descripcion" : n_descripcion, "n_estado":n_estado,"n_usuario":n_usuario},
                async: false,
                url: '../../negocio/GDirectorio/NDirectorio.php',
                type: 'POST',
                datatype: 'json',

                success: function(response) {
                  location.reload();
                  //procesar(response);

                },
                error: function() {
                    alert('Error al obtener informacion');
                }

                });

}


</script>

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
                url: '../../negocio/GDirectorio/NDirectorio.php',
                type: 'POST',
                datatype: 'json',

                success: function(response) {
                  //var datos=JSON.parse(response);
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
