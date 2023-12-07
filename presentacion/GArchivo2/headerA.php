
<!doctype html>
 <html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Estudio Fotografico</title>
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
               <li class="menu-title text-center">panel de control</li>
                    <li class=""><a href="../inicio_a.php"><i class="menu-icon fa fa-home"></i>Inicio </a></li>
                    
                    <li class="menu-title" style="font-size: 12px">G.Directorio/Archivos</li>
                    <li class=""><a href="../GDirectorio/p_listar_directorio_a.php" > <i class="menu-icon fa fa-folder-open"></i>Gestionar</a></li>                    


                    <li class="menu-title "style="font-size: 12px">Gestionar Perfil</li>
                    <li class=""><a href="../GPerfil/p_modificar_perfil_form.php" > <i class="menu-icon fa fa-folder-open"></i>Modificar</a></li> 


                    <li class="menu-title"style="font-size: 12px">Gestionar Ubicacion</li>
                    <li class=""><a href="../GUbicacion/p_modificar_ubicacion.php" > <i class="menu-icon fa fa-binoculars"></i>Modificar</a></li>
                </ul>
            </div>
        </nav>
    </aside>


    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                <a class="navbar-brand text-dark " style="font-size: 12pt;" href="../inicio_a.php"><img src="../../estilo/iconos/balanza.png" width="40" heigth="40" alt="Logo"><?php echo " ".$_SESSION['user'];?>
                <div class=" text-success spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>
                </a>
                    <a class="navbar-brand hidden" href="../inicio_a.php"><img src="../../estilo/iconos/balanza.png" alt="Logo"></a>
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