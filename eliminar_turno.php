<?php
session_start();
include("seguridad.php");
include("conexion.php"); // Conexión a la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: iniciarsesion.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_turno'])) {
        $id_turno = intval($_POST['id_turno']);

        // Obtener datos del turno antes de eliminarlo
        $query_select = "SELECT id_paciente, id_servicio, fecha, hora FROM turnos WHERE id_turno = ?";
        $stmt_select = mysqli_prepare($conexion, $query_select);

        if ($stmt_select) {
            mysqli_stmt_bind_param($stmt_select, "i", $id_turno);
            mysqli_stmt_execute($stmt_select);
            $resultado = mysqli_stmt_get_result($stmt_select);

            if ($row = mysqli_fetch_assoc($resultado)) {
                $id_paciente = $row['id_paciente'];
                $id_servicio = $row['id_servicio'];
                $fecha = $row['fecha'];
                $hora = $row['hora'];

                // Insertar el turno eliminado en la tabla cancelaciones_turnos
                $query_insert = "INSERT INTO tdcancel (id_paciente, id_servicio, fecha, hora) VALUES (?, ?, ?, ?)";
                $stmt_insert = mysqli_prepare($conexion, $query_insert);

                if ($stmt_insert) {
                    mysqli_stmt_bind_param($stmt_insert, "iiss", $id_paciente, $id_servicio, $fecha, $hora);
                    mysqli_stmt_execute($stmt_insert);
                    mysqli_stmt_close($stmt_insert);
                }
            }
            mysqli_stmt_close($stmt_select);
        }

        // Eliminar el turno de la tabla turnos
        $query_eliminarT = "DELETE FROM turnos WHERE id_turno = ?";
        $stmt_delete = mysqli_prepare($conexion, $query_eliminarT);

        if ($stmt_delete) {
            mysqli_stmt_bind_param($stmt_delete, "i", $id_turno);
            mysqli_stmt_execute($stmt_delete);
            mysqli_stmt_close($stmt_delete);
        }
    }
}

mysqli_close($conexion);
header("Location: panelusuario.php");
exit();
?>
