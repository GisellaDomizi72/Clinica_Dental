<?php
//Conexion a la Base de Datos
$host = "localhost"; // Dirección del servidor
$dbname = "clinica_dental";     // Nombre de la base de datos
$user = "root";      // Usuario de la base de datos
$password = "";  // Contraseña del usuario

$conexion = mysqli_connect($host, $user, $password, $dbname);

if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}
?>