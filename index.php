<?php
session_start();
// Verifica si hay una sesión activa de administrador y redirige a la página de administrador
if (!empty($_SESSION['active'])) {
    header('Location: administrador/');
} 
// Verifica si hay una sesión activa de profesor y redirige a la página de profesor
else if (!empty($_SESSION['activeP'])) {
    header('Location: profesor/');
} 
// Verifica si hay una sesión activa de alumno y redirige a la página de alumno
else if (!empty($_SESSION['activeA'])) {
    header('Location: alumno/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./images/gorro-de-graduacion.png" type="image/png">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title> INGRESO AL SISTEMA</title>
</head>

<body>
    <header class="main-header">
        <div class="main-cont">
            <div class="desc-header">
                <img src="images/fondo.png" alt="imagen secundaria aftons">
                <h1>Secundaria Aftons</h1>
            </div>
        </div>
        <div class="cont-header">
            <h1>Bienvenid@</h1>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <!-- pestañas de navegación para seleccionar tipo de usuario -->
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Administrador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profesor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="alumno-tab" data-toggle="tab" href="#alumno" role="tab" aria-controls="alumno" aria-selected="false">Alumno</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Formulario de login para Administrador -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="" onsubmit="return validar()">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
                        <label for="password">Contraseña</label>
                        <input type="password" name="pass" id="pass" placeholder="Contraseña">
                        <div id="messageUsuario"></div>
                        <button id="loginUsuario" type="button">INICIAR SESION</button>
                    </form>
                </div>
                <!-- Formulario de login para Profesor -->
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="" onsubmit="return validar()">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuarioProfesor" id="usuarioProfesor" placeholder="Nombre de usuario">
                        <label for="password">Contraseña</label>
                        <input type="password" name="passProfesor" id="passProfesor" placeholder="Contraseña">
                        <div id="messageProfesor"></div>
                        <button id="loginProfesor" type="button">INICIAR SESION</button>
                    </form>
                </div>
                <!-- Formulario de login para Alumno -->
                <div class="tab-pane fade" id="alumno" role="tabpanel" aria-labelledby="alumno-tab">
                    <form action="" onsubmit="return validar()">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuarioAlumno" id="usuarioAlumno" placeholder="Nombre de usuario">
                        <label for="password">Contraseña</label>
                        <input type="password" name="passAlumno" id="passAlumno" placeholder="Contraseña">
                        <div id="messageAlumno"></div>
                        <button id="loginAlumno" type="button">INICIAR SESION</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/login.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>