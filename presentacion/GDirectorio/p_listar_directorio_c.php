 <?php  
 session_start();   
 if(!isset($_SESSION['user'])){ 
    header('Location:../../index.php');   
  }
  $usuario = $_SESSION['user'];
  require('../../negocio/GDirectorio/NDirectorio.php');
  ?>

<!doctype html>
 <html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Juridico</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../estilo/style.css">
    <link rel="stylesheet" href="../../estilo/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilo/cs-skin-elastic.css">

    <script src="../../estilo/js/jquery.min.js"></script> 
    <script src="../../estilo/js/Chart.js"></script>
   <style>

   #weatherWidget .currentDesc { color: #ffffff!important; }
   .traffic-chart { min-height: 335px; }
   #flotPie1  { height: 150px; }
   #flotPie1 td { padding:3px; }
   #flotPie1 table { top: 20px!important; right: -10px!important; }
   .chart-container { display: table; min-width: 270px ; text-align: left; padding-top: 10px; padding-bottom: 10px; }
   #flotLine5  { height: 105px; }
   #flotBarChart { height: 150px; }
   #cellPaiChart{ height: 160px; }

    </style>
</head>

<body>

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                <li class="menu-title">Juridico</li>
                    <li class="active">
                        <a href="../inicio_c.php"><i class="menu-icon fa  fa-home"></i>Inicio </a>
                    </li>


                   <li class="menu-title" style="font-size: 12px">Repositorio</li>
                    <li class=""><a href="p_listar_directorio_c.php" > <i class="menu-icon fa fa-folder-open"></i>Entrar</a></li>

                    <li class="menu-title "style="font-size: 12px">lista de  Notificaciones</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bell"></i>Visualizar</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="../GNotificacion/p_listar_notificacion_c.php">Lista</a></li>
                            
                        </ul>
                    </li>     
                                      
                </ul>
            </div>
        </nav>
    </aside>

    <div id="right-panel" class="right-panel">

        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                <a class="navbar-brand text-dark " style="font-size: 12pt;" href="../inicio_c.php"><img src="../../estilo/iconos/balanza.png" width="40" heigth="40" alt="Logo"><?php echo " ".$_SESSION['user'];?>
                <div class="spinner-grow text-primary spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>
                </a>

                    <a class="navbar-brand hidden" href="../inicio_c.php"><img src="../../estilo/iconos/balanza.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">


                    <div class="user-area dropdown float-right">

                        <div class="">
                            <a class="nav-link text-danger" href="../../negocio/cierre_sesion.php"><i class="fa fa-power-off"></i> Salir</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>


        <div class="content">

            <div class="animated fadeIn">

                <div class="row">
                    <div class="col col-12">
                      <?php 
                      $listado= new NDirectorio();
                      $resultado = $listado->getListaDirectoriosClie($usuario);?>

                      <div class="col-sm-12">
                        <!--a href="crear_carpeta.php" class="btn btn-success mb-4">Crear Carpeta</a-->

                        <table id="example1" class="table table-bordered table-hover table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                              <thead>
                                  <tr role="row" class="bg-primary">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Archivo: activar para ordenar la columna descendente" style="width: 219px;">Carpeta</th>
                                    <th class="hidden-xs hidden-sm sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Descripción: activar para ordenar la columna ascendente" style="width: 312px;">Descripción</th>
                                    <th class="hidden-xs hidden-sm sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Tamaño: activar para ordenar la columna ascendente" style="width: 50px;">Estado</th>
                                    <th class="hidden-xs hidden-sm sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Subidol el:: activar para ordenar la columna ascendente" style="width: 100px;">Creada el:</th>
                                    
                                  </tr>
                              </thead>
                              <tbody>

                              <?php
                                      
                                    if(!empty($resultado) AND count($resultado) > 0){
                                    foreach ($resultado as $key => $fila) {
                                      echo '<tr role="row" class="odd">';
                                      echo  '<td style="width: 250px" class="sorting_1">';
                                      echo  '<a href="../GArchivo/listar_archivo_c.php?v_carpeta='.$fila[0].'"><img class="rounded" style="width:30px;height:30px;" src="../../estilo/iconos/carpeta1.png"/>'.' '.$fila[0].'</a></td>';
                                      echo '<td class="hidden-xs hidden-sm" style="width: 350px">'.$fila[1].'</td>';

                                      if($fila[2]=="No iniciado"){
                              ?>
                                        <td style="width: 125px;" class="hidden-xs hidden-sm"><span style="font-size: 13px;"><button class="fa fa-circle text-danger" onclick=""></button><?php echo " ".$fila[2]; ?></span></td>
                              <?php
                                      }else if($fila[2]=="En proceso"){
                              ?>
                                        <td style="width: 125px;" class="hidden-xs hidden-sm"><span style="font-size: 13px;"><button  class="fa fa-circle text-success" onclick=""></button><?php echo " ".$fila[2]; ?></span></td>
                              <?php
                                      }else{
                              ?>
                                        <td style="width: 125px;" class="hidden-xs hidden-sm"><span style="font-size: 13px;"><button  class="fa fa-circle text-primary" onclick=""> </button><?php echo " ".$fila[2]; ?></span></td>

                              <?php
                                      }
                                      echo '<td style="width: 125px;" class=" hidden-xs hidden-sm"><span style="font-size: 12px;">'.$fila[3].'</span></td>';
                                     
                              ?>
                                     

                              <?php
                                    
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

                $.ajax({
                data: { "n_usuario":n_usuario, "n_carpeta" : n_carpeta,"n_descripcion" : n_descripcion },
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

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script src="../../estilo/js/jquery.min.js"></script>   
    <script src="../../estilo/js/popper.min.js"></script>    
    <script src="../../estilo/js/bootstrap.min.js"></script>    
    <script src="../../estilo/js/jquery.matchHeight.min.js"></script>
    <script src="../../estilo/js/main.js"></script>

</body>
</html>
