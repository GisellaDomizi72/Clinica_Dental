<?php
include ("seguridad.php");
$rol = $_SESSION['rol'];  // Obtener el rol del usuario desde la sesión.

if ($rol == 1) {
    $misTurnosUrl = "panelusuario.php";  // Rol 1 redirige a panelusuario.php
} elseif ($rol == 2) {
    $misTurnosUrl = "paneldentista.php";  // Rol 2 redirige a paneldentista.php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesionales</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
    
</head>
<body style="padding-top: 100px;">
    <nav class="navbar navbar-expand fixed-top" style="background-color: #c1e5fd;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo $misTurnosUrl; ?>"> <i class="bi bi-calendar-week"></i> Mis Turnos</a>
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
        <h1 class="display-4"> Profesionales DentalCare</h1>
        &nbsp;
        <div class="container my-4">
            <?php
            include("conexion.php"); // Realizo la conexión
            $id_usuario = $_SESSION['id_usuario'];
            // Consultar los registros de la tabla turnos
            $query = "SELECT nombre_d, apellido_d,foto, email, experiencia from dentistas";
            $resultado = mysqli_query($conexion, $query);
            if (mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo "<hr>";
                    echo "<img src='" . $row['foto'] . "' alt='Foto de " . $row['nombre_d'] . "' class='img-fluid rounded-circle' style='width: 150px; height: 150px; object-fit: cover;'>";
                    echo "<h3> Dr: " . $row['nombre_d'] . " " . $row['apellido_d'] . "</h3>";
                    echo "<p> E-mail: " . $row['email'] . "</p>";
                    echo "<p>" . $row['experiencia'] . "</p>";
                    echo "<hr>";
                }
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