<?php
include ("seguridad.php");
include("conexion.php"); // Realizo la conexión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: iniciarsesion.php");
    exit();
}
$id_usuario = $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Dentista</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
    
</head>
<body style="padding-top: 100px;">
    <div class="container text-center my-4">
        <nav class="navbar navbar-expand fixed-top" style="background-color: #c1e5fd;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="paneldentista.php"> <i class="bi bi-calendar-week"></i> Mis Turnos</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="servicios.php"><i class="bi bi-collection"></i> Servicios</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profesionales.php"><i class="bi bi-person-check-fill"></i> Profesionales</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="salir.php"><i class="bi bi-arrow-bar-right"></i> Cerrar Sesión</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container text-center my-4">
        <h1 class="display-4">¡Bienvenido!</h1>
        <p>Verifica los pacientes y horarios de los turnos desde este panel.</p>
        <h2 class="mt-4 text-primary">Tus turnos se encuentran aquí</h2>
        <?php
        // Consultar los turnos asignados al dentista que inició sesión
        $query = "SELECT turnos.id_turno, turnos.fecha, turnos.hora, pacientes.nombre_p, pacientes.apellido_p, servicios.nombre_s 
            FROM turnos 
            INNER JOIN servicios ON turnos.id_servicio = servicios.id_servicio 
            INNER JOIN pacientes ON turnos.id_paciente = pacientes.id_paciente 
            WHERE servicios.id_dentista = (SELECT id_dentista FROM dentistas WHERE id_usuario = '$id_usuario')
            ORDER BY turnos.fecha ASC, turnos.hora ASC";

        $resultado = mysqli_query($conexion, $query);

        if (mysqli_num_rows($resultado) > 0) {
            echo "<div class='table-responsive'>"; // Clase para hacer la tabla responsiva
            echo "<table class='table table-striped table-bordered'>"; // Clases de Bootstrap
            echo "<thead class='table-primary'>"; // Coloca un color de fondo al encabezado
            echo "<tr>";
            echo "<th scope='col'>Fecha</th>";
            echo "<th scope='col'>Hora</th>";
            echo "<th scope='col'>Paciente</th>";
            echo "<th scope='col'>Servicio</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while ($row = mysqli_fetch_assoc($resultado)) {
                // Formatear la hora para mostrar solo horas y minutos
                $hora_formateada = substr($row['hora'], 0, 5); // Toma solo los primeros 5 caracteres (HH:mm)
                echo "<tr>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>" . $hora_formateada . "</td>";
                echo "<td>" . $row['nombre_p'] . " " . $row['apellido_p'] . "</td>";
                echo "<td>" . $row['nombre_s'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>"; // Cierra table-responsive
        } else {
            echo "<p>No tienes turnos asignados.</p>";
        }

        ?>
        <!-- Turnos cancelados de los Dentistas -->
        <div class="container my-4">
        <h2 class="mt-4 text-danger">Turnos Cancelados</h2>
        <p>Aquí podrá ver cuando el Paciente cancele un turno por motivos de fuerza mayor.</p>

        <?php
        $query_cancelaciones = "SELECT c.id_cancelacion, c.fecha, c.hora, p.nombre_p, p.apellido_p, s.nombre_s 
            FROM tdcancel c
            INNER JOIN servicios s ON c.id_servicio = s.id_servicio
            INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
            WHERE s.id_dentista = (SELECT id_dentista FROM dentistas WHERE id_usuario = '$id_usuario')
            ORDER BY c.fecha ASC, c.hora ASC";
        $resultado_cancelaciones = mysqli_query($conexion, $query_cancelaciones);

        if (mysqli_num_rows($resultado_cancelaciones) > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='table-danger'><tr>";
            echo "<th>Fecha</th><th>Hora</th><th>Paciente</th><th>Servicio</th><th scope='col'>Acciones</th></tr></thead>";
            echo "<tbody>";
            
            while ($row = mysqli_fetch_assoc($resultado_cancelaciones)) {
                $hora_formateada = substr($row['hora'], 0, 5);
                echo "<tr>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>" . $hora_formateada . "</td>";
                echo "<td>" . $row['nombre_p'] . " " . $row['apellido_p'] . "</td>";
                echo "<td>" . $row['nombre_s'] . "</td>";
                echo "<td>"
                    . "<form action='eliminar_tdcancelado.php' method='POST' style='display:inline;'>"
                    . "<input type='hidden' name='id_cancelacion' value='{$row['id_cancelacion']}'>"
                    . "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este registro?\");'>"
                    . "<i class='bi bi-trash'></i> Eliminar"
                    . "</button>"
                    . "</form>"
                    . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table></div>";
        } else {
            echo "<p>No hay turnos cancelados.</p>";
        }

        mysqli_close($conexion); // Cerrar la conexión
        ?>
        </div>

    </div>
    <footer style="background-color: #c1e5fd;" class="container-fluid; text-center mt-4"><br><br>
    <div class="row">
        <div>
            <h5 class="display-6">Contactanos</h5><br>
            <p><i class="bi bi-telephone"></i> Teléfono: (261) 123-4567</p>
            <p><i class="bi bi-envelope"></i> Email: info@dentalcare.com</p>
        </div>
    </div>
    <div>
        <p>&copy; 2024 DentalCare. Todos los derechos reservados.</p>
    </div>
    <br>
    </footer>
</body>
</html>