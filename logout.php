<?php

// Inicia una sesión de PHP
session_start();
// Elimina todas las variables de sesión
session_unset();
// Destruye la sesión actual
session_destroy();
// Redirige al usuario a la página especificada en la cabecera
header('Location: ./');