<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>
<body>
    <div  class="container text-center my-4">
        <h1 class="display-4">Registrarse</h1>
        <p>Para registrarse complete los siguientes campos.</p>
        
        <form method="post" action="insertarusuario.php">
            Nombre: <br>
            <input type="text" name="nombre"><br>
            Apellido: <br>
            <input type="text" name="apellido"><br>
            Teléfono: <br>
            <input type="text" name="telefono"><br>
            Usuario: <br>
            <input type="text" name="usuario"><br>
            Contraseña<br>
            <input type="password" name="contrasena"><br><br>
            
            <input type="submit" value="Registrarse" class="btn btn-success" style="border-radius: 20px;">
        </form> <br>

        <form action="index.php">
            <button class="btn btn-primary" style="border-radius: 20px">Volver al Inicio</button>
        </form>
    </div>
</body>
</html>