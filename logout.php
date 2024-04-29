<<<<<<< HEAD
<?php

// Inicia una sesión de PHP
session_start();
// Elimina todas las variables de sesión
session_unset();
// Destruye la sesión actual
session_destroy();
// Redirige al usuario a la página especificada en la cabecera
=======
<?php

session_start();
session_unset();
session_destroy();

>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
header('Location: ./');