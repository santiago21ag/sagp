<?php
require "conexion.php";

try {
    $dbConnection = new DBConnection();
    $conn = $dbConnection->getConnection();
    $query = "SELECT nombre, edad, salario FROM empleado";
    $result = $conn->query($query);
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

?>