<?php
session_start(); // Inicia o reanuda una sesión de usuario
if (!empty($_POST)) { // Verifica si se ha enviado alguna información mediante POST
    // Verifica si los campos de login y contraseña están vacíos
    if (empty($_POST['login']) || empty($_POST['pass'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        // Incluye el archivo de conexión a la base de datos
        require_once 'conexion.php';
        // Obtiene el login y la contraseña proporcionados por el usuario
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        // Consulta SQL para obtener los datos del usuario y su rol (si el usuario no está desactivado)
        $sql = 'SELECT * FROM usuarios as u INNER JOIN rol as r ON u.rol = r.rol_id WHERE u.usuario = ? AND u.estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($login));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        // Verifica si se encontró algún usuario con el nombre de usuario proporcionado
        if ($query->rowCount() > 0) {
            // Verifica si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos
            if (password_verify($pass, $result['clave'])) {
                // Verifica si el usuario está activo (estado = 1)
                if ($result['estado'] == 1) {
                    // Inicia la sesión para el usuario y establece las variables de sesión
                    $_SESSION['active'] = true;
                    $_SESSION['id_usuario'] = $result['usuario_id'];
                    $_SESSION['nombre'] = $result['nombre'];
                    $_SESSION['rol'] = $result['rol_id'];
                    $_SESSION['nombre_rol'] = $result['nombre_rol'];
                    // Muestra un mensaje de éxito y probablemente redirecciona a otra página
                    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Redirecting</div>';
                } else {
                    // Muestra un mensaje de advertencia si el usuario está inactivo
                    echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>Usuario inactivo, comuniquese con el administrador</div>';
                }
            } else {
                // Muestra un mensaje de error si la contraseña no coincide
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Usuario o Clave incorrectos</div>';
            }
        } else {
            // Muestra un mensaje de error si no se encontró ningún usuario con el nombre de usuario proporcionado
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Usuario o Clave
            incorrectos</div>';
        }
    }
}
