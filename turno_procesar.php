<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
include("conexion.php"); // Realizo la conexión

// Obtener el id_usuario desde la sesión
$id_usuario = $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container text-center my-4">
    <?php
    // Buscar el id_paciente correspondiente al id_usuario
    $query_paciente = "SELECT id_paciente FROM pacientes WHERE id_usuario = $id_usuario";
    $result_paciente = mysqli_query($conexion, $query_paciente);
    $row_paciente = mysqli_fetch_assoc($result_paciente);

    if ($row_paciente) {
        $id_paciente = $row_paciente['id_paciente'];
    } else {
        die("<p class='text-danger'>No se encontró un paciente asociado al usuario actual.</p>");
    }

    if (isset($_POST['fecha'], $_POST['hora'], $_POST['servicio'])) {
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $id_servicio = $_POST['servicio'];

        if (!empty($fecha) && !empty($hora) && !empty($id_servicio)) {
            $query_insertar = "INSERT INTO turnos (fecha, hora, id_paciente, id_servicio) VALUES ('$fecha', '$hora', '$id_paciente', '$id_servicio')";
            $resultado_insertar = mysqli_query($conexion, $query_insertar);

            if ($resultado_insertar) {
                echo "<br><br><h2 class='display-4'>Turno reservado con éxito.</h2>";
                echo "<a href='panelusuario.php' class='btn btn-primary mt-3'>Volver a Mis Turnos</a>";
            } else {
                echo "<h2 class='display-4'>Error al reservar el turno.</h2>";
            }
        } else {
            echo "<h2 class='display-4'>Todos los campos son obligatorios.</h2>";
        }
    } else {
        echo "<h2 class='display-4'>Faltan datos para procesar el turno.</h2>";
    }

    mysqli_close($conexion);
    ?>
</div>
</body>
</html> 
