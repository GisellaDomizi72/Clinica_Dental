<?php
// Inicio de sesión
session_start();
error_reporting(0);
// Comprueba que el usuario está autenticado
if (!isset($_SESSION["autentificado"]) ||$_SESSION["autentificado"] != "1") {
    // Si no está autenticado, redirigimos al inicio
    header("Location: index.php");
    die();//salimos del script
    
}
?>