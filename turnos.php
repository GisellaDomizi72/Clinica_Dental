<?php
include("seguridad.php");
include("conexion.php"); // Realizo la conexión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

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
    <h2 class="display-5">Gestión de Turno</h2><br>
    <div class="alert alert-primary" role="alert">
        Recuerde que la clínica no atiende los sábados, domingos y feriados. Seleccione un día hábil para sacar un turno.
    </div>
    
    <form method="POST" action="horario.php">
        <!-- Formulario para seleccionar el servicio -->
        <label for="servicio" class="form-label">Selecciona un servicio:</label>
        <select id="servicio" name="servicio" class="form-select mb-3" required>
            <option value="">Servicios:</option>
            <?php
            // Consultar servicios desde la base de datos
            $query_servicio = "SELECT id_servicio, nombre_s FROM servicios";
            $resultado_servicio = mysqli_query($conexion, $query_servicio);

            while ($row = mysqli_fetch_assoc($resultado_servicio)) {
                echo "<option value='{$row['id_servicio']}' data-dentista='{$row['id_dentista']}'>{$row['nombre_s']}</option>";
            }
            ?>
        </select>

        <!-- Formulario para seleccionar fecha -->
        <label for="fecha" class="form-label">Selecciona un día: </label><br>
        <input type="date" id="fecha" name="fecha" class="form-control mb-3" required>
        <button type="submit" class="btn btn-primary" style="border-radius: 20px">Ver Horarios Disponibles</button>
    </form>

    <form action="panelusuario.php">
        <button class="btn btn-secondary mt-3" style="border-radius: 20px">Cancelar</button>
    </form>
</div>
</body>
</html>