<?php
session_start(); // Iniciar sesión si no está iniciada
// Destruir todas las variables de sesión
session_unset();
// Destruir la sesión
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fin de Sesión</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
    
</head>
<body style="padding-top: 100px;" class="container text-center my-4">
    <h2 class="display-4">Has cerrado la sesión exitosamente.</h2>
    <p>¡Gracias por tu visita!</p>
    <br/><br/>
    <form action="index.php">
        <button class="btn btn-primary" style="border-radius: 20px">Ir a la Página de Inicio</button>
    </form>
</body>
</html>