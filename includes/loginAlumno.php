<?php
session_start(); // Inicia o reanuda una sesión de usuario

if (!empty($_POST)) { // Verifica si se ha enviado alguna información mediante POST
    // Verifica si los campos de login y contraseña están vacíos
    if (empty($_POST['loginAlumno']) || empty($_POST['passAlumno'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        // Incluye el archivo de conexión a la base de datos
        require_once 'conexion.php';
        // Obtiene el login y la contraseña proporcionados por el usuario
        $login = $_POST['loginAlumno'];
        $pass = $_POST['passAlumno'];
        // Consulta SQL para obtener los datos del alumno usando su cédula como parámetro
        $sql = 'SELECT * FROM alumnos WHERE cedula = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($login));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        // Verifica si se encontró algún alumno con la cédula proporcionada
        if ($query->rowCount() > 0) {
            // Obtiene la fecha y hora actual en el formato específico
            date_default_timezone_set("America/Bogota");
            $fecha = date('Y-m-d H:i:s');
            // Obtiene el ID del alumno encontrado en la consulta
            $id_alumno = $result['alumno_id'];
            // Actualiza el campo de última fecha de acceso del alumno en la base de datos
            $sql = "UPDATE alumnos SET u_acceso = '$fecha' WHERE alumno_id = ?";
            $query = $pdo->prepare($sql);
            $res = $query->execute(array($id_alumno));
            // Verifica si la actualización se realizó correctamente
            if ($res) {
                // Verifica si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos
                if (password_verify($pass, $result['clave'])) {
                    // Inicia la sesión para el alumno y establece las variables de sesión
                    $_SESSION['activeA'] = true;
                    $_SESSION['alumno_id'] = $result['alumno_id'];
                    $_SESSION['nombre'] = $result['nombre_alumno'];
                    $_SESSION['cedula'] = $result['cedula'];
                    $_SESSION['u_acceso'] = $result['u_acceso'];
                    // Muestra un mensaje de éxito y probablemente redirecciona a otra página
                    echo '<div class-Talert alert-success"> <button type="button" class="close" data-dismiss="alert"></button>Redirecting</div>';
                }
            } else {
                // Muestra un mensaje de error si la contraseña no coincide
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o Clave incorrectos</div>';
            }
        } else {
            // Muestra un mensaje de error si no se encontró ningún alumno con la cédula proporcionada
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o Clave
            incorrectos</div>';
        }
    }
}
