<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body style="padding-top: 60px;"class="container text-center my-4">
    <?php
    // Realizamos la conexión a la base de datos
    include("conexion.php");

    // Traemos los valores ingresados para usuario con POST
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];

    // Validación de teléfono (expresión regular)
    $regex_telefono = '/^[0-9]{10,11}$/';

    // Verificamos si el teléfono tiene un formato válido
    if (!preg_match($regex_telefono, $telefono)) {
        echo "<script>alert('El teléfono debe ser un número de entre 10 y 11 dígitos.'); window.location.href='registrarse.php';</script>";
        exit();
    }

    // Verificamos si el nombre de usuario ya existe
    $consulta_usuario = "SELECT * FROM usuarios WHERE nombre = '$usuario'";
    $resultado_usuario = mysqli_query($conexion, $consulta_usuario);

    if (mysqli_num_rows($resultado_usuario) > 0) {
        // Si el usuario ya existe, mostramos un mensaje de error
        echo "<script>alert('El nombre de usuario ya está registrado. Por favor, elige otro.'); window.location.href='registrarse.php';</script>";
    } else {
        // Aplicamos hashing a la contraseña
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Realizamos la consulta para insertar el usuario
        $query_usuario = "INSERT INTO usuarios (nombre, contrasena) VALUES ('$usuario', '$hashed_password')";

        if (mysqli_query($conexion, $query_usuario)) {
            // Obtenemos el id_usuario recién insertado
            $id_usuario = mysqli_insert_id($conexion);

            // Insertamos los datos en la tabla pacientes usando el id_usuario obtenido
            $query_paciente = "INSERT INTO pacientes (nombre_p, apellido_p, telefono_p, id_usuario) VALUES ('$nombre', '$apellido', '$telefono', '$id_usuario')";
            mysqli_query($conexion, $query_paciente);
        }
    }

    // Liberamos los resultados y cerramos la conexión a la base de datos
    mysqli_free_result($resultado_usuario);
    mysqli_close($conexion);
    ?>
    <h2 class="display-4">¡Se ha registrado exitosamente!</h2><br><br>

    <form action="index.php">
        <button class="btn btn-primary" style="border-radius: 20px">Volver a la página de Inicio</button>
    </form><br>
    <form action="iniciarsesion.php">
        <button class="btn btn-primary" style="border-radius: 20px">Iniciar Sesión</button>
    </form>
</body>
</html>
