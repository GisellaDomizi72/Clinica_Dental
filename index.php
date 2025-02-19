<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Dental</title>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
</head>
<body  style="padding-top: 100px;" id="ini">

    <div class="container text-center my-4">
        <nav class="navbar navbar-expand fixed-top" style="background-color: #c1e5fd;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#ini"><i class="bi bi-stars"></i> Bienvenida</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#his"><i class="bi bi-book"></i> Historia</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#ubi"><i class="bi bi-geo-alt-fill"></i> Ubicación</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="registrarse.php"><i class="bi bi-person-fill-add"></i> Registrarse</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="iniciarsesion.php"><i class="bi bi-person-check-fill"></i> Iniciar Sesión</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
        <div id="Inicio" align="center" class="container">
            <h1 class="display-4">- Clínica Dental -</h1>
            <img src="Public/logoo.png" alt="Logo de la Clinica" width="480" class="img-fluid"> 
            <h3 class="display-4">¡Bienvenido!</h3><br>
            <p>Tu salud bucal es nuestra prioridad, estamos aquí para ayudarte.</p>
            <p> En nuestra plataforma, podrás gestionar tus citas, conocer a nuestros especialistas y acceder al catalogo de servicios y tarifas.</p>
            <br>
            <hr>
            <h3 class="display-4">Ingresa a DentalCare</h3>
            <p>Inicia sesión para comenzar o regístrate si aún no tienes una cuenta.</p>
            <div style="display: flex; justify-content: center; gap: 10px;">
                <form action="iniciarsesion.php">
                    <button  class="btn btn-primary" style="border-radius: 20px">Iniciar Sesión</button>
                </form>
                <form action="registrarse.php">
                    <button class="btn btn-primary" style="border-radius: 20px">Registrarse</button>
                </form>
            </div>
        </div>
        <hr id="his"><br><br>
        <h1 class="display-4" > Historia de DentalCare</h1><br>
        <p>DentalCare nació hace una década del sueño de la Dra. Clara Montaña y la Dra. Juana Mendoza de crear una clínica que priorizara la atención personalizada.</p>
        <p> Con recursos limitados y mucha determinación, abrieron un pequeño consultorio. A pesar de los desafíos iniciales, su dedicación y empatía atrajeron a la comunidad, permitiéndoles crecer y sumar a la Dra. Aline Marquez como especialista en ortodoncia.</p>
        <p> Hoy, DentalCare es un referente en salud dental, transformando vidas con calidad, calidez y compromiso en cada sonrisa que devuelve. </p>
        <img  class="img-fluid" src="Public/clinica.jpg" alt="Foto de la Clinica" width="380"> 
        <br><br><br><hr id="ubi"><br><br>
        <h1 class="display-4" >¿Donde nos encontramos?</h1><br>
        <p>Estamos en Mariano Moreno, Alexander Fleming &, Villa Tulumaya, Mendoza.</p>
        <div class="ratio ratio-16x9">
        <iframe class="display-4" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d705.6380065895167!2d-68.60147479049203!3d-32.72197354135429!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzLCsDQzJzE5LjEiUyAtNjjCsDM2JzA1LjMiVw!5e0!3m2!1ses-419!2sar!4v1733534737268!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <br><br><hr>
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