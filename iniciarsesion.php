<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
    
</head>
<body style="padding-top: 60px;"class="container text-center my-4">
    <div>
        <h1 class="display-4"><i class="bi bi-person" style="font-size: 40px;"></i>  Iniciar Sesión</h1>
       <br>
        <form action="autenticacion.php" method="POST">
            <label for="usuario">Nombre:</label>
            <input type="text" name="usuario" id="usuario" required /><br><br>

            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" required /><br><br>

            <input type="submit" value="Ingresar" class="btn btn-success" style="border-radius: 20px;">
        </form><br>
        <form action="index.php">
            <button class="btn btn-primary" style="border-radius: 20px">Volver al Inicio</button>
        </form>
    </div>
</body>
</html>