<?php
include("seguridad.php");
include("conexion.php"); // Conectar a la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: iniciarsesion.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el formulario tiene el id_cancelacion
    if (isset($_POST['id_cancelacion'])) {
        $id_cancelacion = $_POST['id_cancelacion']; // Obtener el id de cancelación desde el formulario

        // Consulta para eliminar el turno cancelado al paciente por id_cancelacion
        $query_delete = "DELETE FROM tpcancel WHERE id_cancelacion = ? AND id_paciente = (SELECT id_paciente FROM pacientes WHERE id_usuario = ?)";
        $resultado = mysqli_prepare($conexion, $query_delete);

        if ($resultado) {
            // Vincular el parámetro y ejecutar la consulta
            mysqli_stmt_bind_param($resultado, "ii", $id_cancelacion, $id_usuario); 
            $ejecutado = mysqli_stmt_execute($resultado);

            // Cerrar la sentencia preparada
            mysqli_stmt_close($resultado);

            // Verificar si la ejecución fue exitosa
            if ($ejecutado) {
                header("Location: panelusuario.php");
                exit();
            } else {
                echo "Error al eliminar la cancelación. Por favor, intente de nuevo.";
            }
        } else {
            echo "Error al preparar la consulta. Por favor, intente de nuevo.";
        }
    }
}
mysqli_close($conexion);
?>