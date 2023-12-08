<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables + Highcharts Example</title>
    
    <!-- Incluye las bibliotecas necesarias -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    
</head>
<body>

    <h2>DataTables + Highcharts Example</h2>
    
    <table id="example" class="display" style="width:100%">
        
    </table>

    <div id="chart-container-bar" style="height: 400px; margin-top: 20px;"></div>
    <div id="chart-container-line" style="height: 400px; margin-top: 20px;"></div>
    <div id="chart-container-pie" style="height: 400px; margin-top: 20px;"></div>

    <script>       

        var dataDB;
        var lista_pie = [];
        var nombres = [];
        var edades = [];
        var salarios = [];
        //var flag='db';
        var flag='no db';

        $(document).ready(function() {
            if(flag=='db'){
                
                $.ajax({
                data: null,
                async: false,
                url: 'data_db.php',
                type: 'get',
                datatype: 'json',
                success: function(response) {
                  dataDB = JSON.parse(response);       
                },
                error: function() {
                  alert('Error al obtener informacion');
                }
                });
                $('#example').DataTable({
                    data: dataDB,
                    columns: [
                        { data: 'nombre' },
                        { data: 'edad' },
                        { data: 'salario' }
                    ]
                });
                for (let index = 0; index < dataDB.length; index++) {
                    const element = dataDB[index];
                    nombres.push(element.nombre);
                    edades.push(Math.floor(element.edad));
                    salarios.push(Math.floor(element.salario));

                    lista_pie.push({ name: element.nombre, y: Math.floor(element.edad) },);
                }
            
            
                Highcharts.chart('chart-container-bar', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Bar Chart'
                    },
                    xAxis: {
                        categories: nombres
                    },
                    yAxis: {
                        title: {
                            text: 'Salario'
                        }
                    },
                    series: [{
                        name: 'Salario',
                        data: salarios
                    }]
                });

                
                Highcharts.chart('chart-container-line', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Line Chart'
                    },
                    xAxis: {
                        categories: nombres
                    },
                    yAxis: {
                        title: {
                            text: 'Edad'
                        }
                    },
                    series: [{
                        name: 'edad',
                        data: edades
                    }]
                });

                Highcharts.chart('chart-container-pie', {
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: 'Pie Chart'
                    },
                    series: [{
                        name: 'Edad',
                        data: lista_pie
                    }]
                });

            }else{
                fetch('data.json')
                .then(response => response.json())
                .then(data => {
                    dataDB = data;
                    $('#example').DataTable({
                    data: dataDB,
                    columns: [
                        { data: 'nombre' },
                        { data: 'edad' },
                        { data: 'salario' }
                    ]
                    });
                    for (let index = 0; index < dataDB.length; index++) {
                        const element = dataDB[index];
                        nombres.push(element.nombre);
                        edades.push(Math.floor(element.edad));
                        salarios.push(Math.floor(element.salario));

                        lista_pie.push({ name: element.nombre, y: Math.floor(element.edad) },);
                    }

                    Highcharts.chart('chart-container-bar', {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Bar Chart'
                        },
                        xAxis: {
                            categories: nombres
                        },
                        yAxis: {
                            title: {
                                text: 'Salario'
                            }
                        },
                        series: [{
                            name: 'Salario',
                            data: salarios
                        }]
                    });

                    
                    Highcharts.chart('chart-container-line', {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Line Chart'
                        },
                        xAxis: {
                            categories: nombres
                        },
                        yAxis: {
                            title: {
                                text: 'Edad'
                            }
                        },
                        series: [{
                            name: 'edad',
                            data: edades
                        }]
                    });

                    Highcharts.chart('chart-container-pie', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: 'Pie Chart'
                        },
                        series: [{
                            name: 'Edad',
                            data: lista_pie
                        }]
                    });

                })
                .catch(error => console.error('Error al cargar el archivo JSON:', error));
            }
            
          


                

                

        

        
        /*
        
        */
    });
        
    </script>
 <!--script src="https://code.jquery.com/jquery-3.6.4.min.js"></script!-->
 <!--script src="estilo/js/jquery.min.js"></script--> 
</body>
</html>