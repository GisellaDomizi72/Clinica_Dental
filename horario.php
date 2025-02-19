<?php 
include("seguridad.php");
include("conexion.php");
session_start();

$id_usuario = $_SESSION['id_usuario'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container text-center my-4">
    <h2 class="display-5">Gestión de Turno</h2><br>
   
    <?php
    if (isset($_POST['fecha']) && isset($_POST['servicio'])) {
        $fecha_seleccionada = $_POST['fecha'];
        $servicio_seleccionado = $_POST['servicio'];

        echo "<h3 class='display-6'>Horarios disponibles para el día: $fecha_seleccionada</h3>";

        // Obtener el id_dentista del servicio seleccionado
        $query_dentista = "SELECT id_dentista FROM servicios WHERE id_servicio = '$servicio_seleccionado'";
        $resultado_dentista = mysqli_query($conexion, $query_dentista);

        if (!$resultado_dentista) {
            die("<p class='text-danger'>Error en la consulta de dentista: " . mysqli_error($conexion) . "</p>");
        }

        $fila_dentista = mysqli_fetch_assoc($resultado_dentista);

        if (!$fila_dentista) {
            echo "<p class='text-danger'>Error: No se encontró el dentista para el servicio seleccionado.</p>";
            exit();
        }

        $id_dentista = $fila_dentista['id_dentista'];

        // Consulta de horarios disponibles solo para el dentista del servicio
        $query_horarios_disponibles = "
            SELECT h.hora 
            FROM horarios h 
            WHERE h.hora NOT IN (
                SELECT t.hora 
                FROM turnos t 
                JOIN servicios s ON t.id_servicio = s.id_servicio
                WHERE t.fecha = '$fecha_seleccionada'
                AND s.id_dentista = '$id_dentista'
            )";

        $resultado_disponibles = mysqli_query($conexion, $query_horarios_disponibles);

        if (!$resultado_disponibles) {
            die("<p class='text-danger'>Error en la consulta de horarios: " . mysqli_error($conexion) . "</p>");
        }

        $horarios_disponibles = [];
        while ($row = mysqli_fetch_assoc($resultado_disponibles)) {
            $horarios_disponibles[] = $row['hora'];
        }

        echo "<form method='POST' action='turno_procesar.php'>";
        echo "<input type='hidden' name='fecha' value='$fecha_seleccionada'>";
        echo "<input type='hidden' name='servicio' value='$servicio_seleccionado'>";
        echo "<input type='hidden' name='id_dentista' value='$id_dentista'>";
        echo "<div class='d-flex flex-wrap justify-content-center'>";

        if (!empty($horarios_disponibles)) {
            foreach ($horarios_disponibles as $hora) {
                $hora_formateada = substr($hora, 0, 5);
                echo "<button type='submit' class='btn btn-outline-primary m-2' name='hora' value='$hora'>";
                echo "<i class='bi bi-clock'></i> $hora_formateada";
                echo "</button>";
            }
        } else {
            echo "<p class='text-danger'>No hay horarios disponibles para esta fecha.</p>";
        }

        echo "</div>";
        echo "</form>";
    } else {
        echo "<p class='text-danger'>Faltan datos para mostrar los horarios disponibles.</p>";
    }
    ?>

    <form action="panelusuario.php">
        <button class="btn btn-secondary mt-3" style="border-radius: 20px">Cancelar</button>
    </form>
</div>
</body>
</html>
