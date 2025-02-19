<?php
include("conexion.php");
session_start();
// Obtén los datos del formulario de registro
$user = $_POST["usuario"];
$pass = $_POST["contrasena"];

// Consulta para obtener el usuario desde la base de datos
$consulta = "SELECT * FROM usuarios WHERE nombre = '$user'";
$resultado = (mysqli_query($conexion, $consulta));

if (mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_assoc($resultado);

    // Verificamos si la contraseña ingresada es válida usando password_verify
    if (password_verify($pass, $row['contrasena'])) {
        //session_start();
        $_SESSION["autentificado"] = "1";
        $_SESSION["id_usuario"] = $row["id_usuario"];
        $_SESSION["rol"] = $row["rol"];

        // Redirigir según el rol del usuario
        if ($row["rol"] == "1") {
            header("location: panelusuario.php");
        } elseif ($row["rol"] == "2") {
            header("location: paneldentista.php");
        }
    } else {
        // Si la contraseña no es correcta
        echo "<script>alert('El Usuario y/o la Contraseña son incorrectos'); window.location.href='index.php';</script>";
    }
} else {
    // Si el usuario no existe
    echo "<script>alert('El Usuario y/o la Contraseña son incorrectos'); window.location.href='index.php';</script>";
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>