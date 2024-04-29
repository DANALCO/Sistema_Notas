<<<<<<< HEAD
<<<<<<< HEAD
<?php
session_start(); // Inicia o reanuda una sesión de usuario
if (!empty($_POST)) { // Verifica si se ha enviado alguna información mediante POST
    // Verifica si los campos de login y contraseña están vacíos
    if (empty($_POST['loginProfesor']) || empty($_POST['passProfesor'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        // Incluye el archivo de conexión a la base de datos
        require_once 'conexion.php';
        // Obtiene el login y la contraseña proporcionados por el usuario
        $login = $_POST['loginProfesor'];
        $pass = $_POST['passProfesor'];

        // Consulta SQL para obtener los datos del profesor usando su cédula como parámetro
        $sql = 'SELECT * FROM profesor WHERE cedula = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($login));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        // Verifica si se encontró algún profesor con la cédula proporcionada
        if ($query->rowCount() > 0) {
            // Verifica si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos
            if (password_verify($pass, $result['clave'])) {
                // Inicia la sesión para el profesor y establece las variables de sesión
                $_SESSION['activeP'] = true;
                $_SESSION['profesor_id'] = $result['profesor_id'];
                $_SESSION['nombre'] = $result['nombre'];
                $_SESSION['cedula'] = $result['cedula'];
                // Muestra un mensaje de éxito y probablemente redirecciona a otra página
                echo '<div class-Talert alert-success"> <button type="button" class="close" data-dismiss="alert"></button>Redirecting</div>';
            } else {
                // Muestra un mensaje de error si la contraseña no coincide
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o Clave incorrectos</div>';
            }
        } else {
            // Muestra un mensaje de error si no se encontró ningún profesor con la cédula proporcionada
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o Clave
            incorrectos</div>';
        }
    }
}
=======
<?php
session_start();
if(!empty($_POST)) {
    if (empty($_POST['loginProfesor']) || empty($_POST['passProfesor'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        require_once 'conexion.php';
        $login = $_POST['loginProfesor'];
        $pass = $_POST['passProfesor'];

        $sql = 'SELECT * FROM profesor WHERE cedula = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($login));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($query->rowCount() > 0) {
            if(password_verify($pass, $result['clave'])) {
                $_SESSION['activeP'] = true;
                $_SESSION['profesor_id'] = - $result['profesor_id'];
                $_SESSION['nombre'] = $result['nombre'];
                $_SESSION['cedula'] = $result['cedula'];
                
                echo '<div class-Talert alert-success"> <button type="button" class="close" data-dismiss="alert"></button>Redirecting</div>';
            }else {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o Clave incorrectos</div>';
            }
        } else {
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o Clave
            incorrectos</div>';
        }
    }
}
>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
=======
<?php
session_start();
if(!empty($_POST)) {
    if (empty($_POST['loginProfesor']) || empty($_POST['passProfesor'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        require_once 'conexion.php';
        $login = $_POST['loginProfesor'];
        $pass = $_POST['passProfesor'];

        $sql = 'SELECT * FROM profesor WHERE cedula = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($login));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($query->rowCount() > 0) {
            if(password_verify($pass, $result['clave'])) {
                $_SESSION['activeP'] = true;
                $_SESSION['profesor_id'] = - $result['profesor_id'];
                $_SESSION['nombre'] = $result['nombre'];
                $_SESSION['cedula'] = $result['cedula'];
                
                echo '<div class-Talert alert-success"> <button type="button" class="close" data-dismiss="alert"></button>Redirecting</div>';
            }else {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o Clave incorrectos</div>';
            }
        } else {
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o Clave
            incorrectos</div>';
        }
    }
}
>>>>>>> ebccd87b7d06dca01d7c509e93888b1f9b88a962
