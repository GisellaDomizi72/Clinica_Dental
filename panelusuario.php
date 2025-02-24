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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
    
</head>
<body style="padding-top: 100px;" >
    <nav class="navbar navbar-expand fixed-top" style="background-color: #c1e5fd;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="panelusuario.php"> <i class="bi bi-calendar-week"></i> Mis Turnos</a>
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
    <div class="container text-center my-4">
        <h1 class="display-4">¡Bienvenido!</h1>
        <h2 class="mt-4 text-primary">Tus turnos se encuentran aquí</h2>
        <div class="container my-4">
        <?php
            // Consultar los registros de la tabla turnos
            $query = "SELECT turnos.id_turno, turnos.fecha, turnos.hora, servicios.nombre_s, dentistas.nombre_d, dentistas.apellido_d FROM turnos INNER JOIN servicios ON turnos.id_servicio = servicios.id_servicio INNER JOIN dentistas ON servicios.id_dentista = dentistas.id_dentista WHERE turnos.id_paciente IN (SELECT id_paciente FROM pacientes WHERE id_usuario = '$id_usuario')";
            $resultado = mysqli_query($conexion, $query);
            if (mysqli_num_rows($resultado) > 0) {
                echo "<div class='table-responsive'>"; // Clase para hacer la tabla responsiva
                echo "<table class='table table-striped table-bordered'>"; // Clases de Bootstrap
                echo "<thead class='table-primary'>"; // Coloca un color de fondo al encabezado
                echo "<tr>";
                echo "<th scope='col'>Fecha</th>";
                echo "<th scope='col'>Hora</th>";
                echo "<th scope='col'>Servicio</th>";
                echo "<th scope='col'>Dentista</th>";
                echo "<th scope='col'>Acciones</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($resultado)) {
                    // Formatear la hora para mostrar solecho "<th scope='col'>Acciones</th>";o horas y minutos
                    $hora_formateada = substr($row['hora'], 0, 5); // Toma solo los primeros 5 caracteres (HH:mm)
                    echo "<tr>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $hora_formateada . "</td>"; // Mostrar hora formateada
                    echo "<td>" . $row['nombre_s'] . "</td>";
                    echo "<td>" . $row['nombre_d'] . " " . $row['apellido_d'] . "</td>";
                    echo "<td>"
                        . "<form action='eliminar_turno.php' method='POST' style='display:inline;'>"
                        . "<input type='hidden' name='id_turno' value='{$row['id_turno']}'>"
                        . "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este turno?\");'>"
                        . "<i class='bi bi-trash'></i> Eliminar"
                        . "</button>"
                        . "</form>"
                        . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>"; // Cierra table-responsive
            } else {
                echo "<p>No tienes turnos asignados.</p>";
            }
            ?>
        </div>
        <div>
            <form action="turnos.php">
                <button class="btn btn-primary" style="border-radius: 20px">Sacar Turno</button>
            </form><br>
            <div class="alert alert-primary" role="alert">
            Al momento de sacar turno recuerde que los días sábados, domingos y feriados la clinica no abre y se pierde el turno correspondiente a ese día.
            </div>
        </div>
        <div class="container my-4">
            <!-- Turnos Cancelados de los Pacientes-->
            <h2 class="mt-4 text-danger">Turnos Cancelados</h2>
            <p>Aquí podrá ver cuando el Dentista cancele un turno por motivos de fuerza mayor.</p>
            <?php
            $query_cancelaciones = "SELECT c.id_cancelacion, c.fecha, c.hora, s.nombre_s, d.nombre_d, d.apellido_d 
            FROM tpcancel c
            INNER JOIN servicios s ON c.id_servicio = s.id_servicio
            INNER JOIN dentistas d ON s.id_dentista = d.id_dentista
            WHERE c.id_paciente = (SELECT id_paciente FROM pacientes WHERE id_usuario = '$id_usuario')
            ORDER BY c.fecha ASC, c.hora ASC";
            $resultado_cancelaciones = mysqli_query($conexion, $query_cancelaciones);

            if (mysqli_num_rows($resultado_cancelaciones) > 0) {
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='table-danger'><tr>";
                echo "<th>Fecha</th><th>Hora</th><th>Servicio</th><th>Dentista</th><th scope='col'>Acciones</th></tr></thead>";
                echo "<tbody>";

                while ($row = mysqli_fetch_assoc($resultado_cancelaciones)) {
                    $hora_formateada = substr($row['hora'], 0, 5);
                    echo "<tr>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $hora_formateada . "</td>";
                    echo "<td>" . $row['nombre_s'] . "</td>";
                    echo "<td>" . $row['nombre_d'] . " " . $row['apellido_d'] . "</td>";
                    echo "<td>"
                        . "<form action='eliminar_tpcancelado.php' method='POST' style='display:inline;'>"
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
                echo "<p>No tienes turnos cancelados.</p>";
            }
            mysqli_close($conexion); // Cerrar la conexión
            ?>
        </div>
    </div>

    <footer style="background-color: #c1e5fd;" class="container-fluid text-center mt-4"><br><br>
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