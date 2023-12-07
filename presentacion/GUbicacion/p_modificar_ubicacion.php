<?php session_start();if(!isset($_SESSION['user'])){header('Location:../../index.php');}require('headerR.php');
$usuario=$_SESSION['user'];
require('../../negocio/GUbicacion/NUbicacion.php');?>
       
               <div class="content">
                <?php 

                    $obtener=new NUbicacion();
                    $rol = $obtener->getRolN($usuario);
                    if($rol[0]['rol']=="Fotografo"){
                          header('Location:../inicio_a.php');
                    }
                    $fila1 = $obtener->getUbicacionN($usuario);
                     
                                            
                ?>

                <input id="latitud"  name="latitud"  type="hidden" value="<?php echo $fila1[0]['latitud']; ?>">
                <input id="longitud" name="longitud" type="hidden" value="<?php echo $fila1[0]['longitud']; ?>">
                <input id="usuario"  name="usuario"  type="hidden" value="<?php echo $usuario; ?>">
                <div id="map"></div>
                <Button class="btn btn-success mt-3" onclick="modificarUbicacion();">Guardar ubicacion</Button> 
                <!--p id="coordenadas"><?php echo "LAT: ".$fila1[0]['latitud']."<br>LNG: ".$fila1[0]['longitud']; ?></p-->
          </div>

       

    </div>

 <script>
  const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  let labelIndex = 0;
  var array=new Array();
  var latitud="";
  var longitud="";
  var usuario="";
 

  
function initMap() {
  
  var lat=document.getElementById("latitud").value;  
  var lng=document.getElementById("longitud").value; 
  const coord = { lat: parseFloat(lat), lng: parseFloat(lng) };
  
  var myLatlng = new google.maps.LatLng(lat,lng);

  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 12,
    center: coord,
    //mapTypeId: "terrain",
  });
  let marker2=new google.maps.Marker({ position:myLatlng });

  array.push(marker2);  
  array[0].setMap(map);
  google.maps.event.addListener(map,'click',function(event) {
    addMarker(event.latLng, map);
      
   });
}


function addMarker(location, map) {
    
    array[0].setMap(null);
    array.pop();
   const marker =new google.maps.Marker({
                        position: location,                                                
                        title:'<?php echo $_SESSION['user']; ?>',
                        draggable:false,
                        label: labels[labelIndex++ % labels.length],
                        //map: map,
                        //visible:false
                      });
   array.push(marker);
   array[0].setMap(map);
    latitud=location.lat().toString();
    longitud=location.lng().toString();
    /*document.getElementById("coordenadas").innerHTML = "LAT: "+location.lat().toString()+"<br>     LNG: "+location.lng().toString();*/

}

 

function modificarUbicacion(){
          //latitud=document.getElementById("latitud").value;
          //longitud=document.getElementById("longitud").value;
          usuario=document.getElementById("usuario").value;
         
          mi_ajax(latitud,longitud,usuario);
}

function mi_ajax(latitud,longitud,usuario){
               // alert("LAT: "+latitud +"  LNG: "+longitud + " usuario: "+usuario);
                $.ajax({
                data: { "latitud":latitud,"longitud" : longitud,"usuario" : usuario},
                async: false,
                url: '../../negocio/GUbicacion/NUbicacion.php',
                type: 'POST',
                datatype: 'json',

                success: function(response) {
                  var datos=JSON.parse(response);
                  alert(datos);
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


<?php require('footerR.php'); ?>


</body>
</html>
