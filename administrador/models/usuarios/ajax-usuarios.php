<?php
// Requiere el archivo de conexión
require_once '../../../includes/conexion.php';
// Verifica si se recibieron datos por POST
if (!empty($_POST)) {
    // Verifica si algún campo necesario está vacío
    if (empty($_POST['nombre']) || empty($_POST['usuario'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Obtiene los datos enviados por POST
        $idusuario = $_POST['idusuario'];
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $rol = $_POST['listRol'];
        $estado = $_POST['listEstado'];
        // Prepara la consulta para verificar si el usuario ya existe
        $sql = 'SELECT * FROM usuarios WHERE usuario = ? AND usuario_id != ? AND estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($usuario, $idusuario));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        // Verifica si el usuario ya existe
        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El usuario ya existe');
        } else {
            // Determina si se va a insertar un nuevo usuario o actualizar uno existente
            if ($idusuario == '') {
                // Si no se proporcionó un ID de usuario, se inserta un nuevo usuario
                $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
                $sqlInsert = 'INSERT INTO usuarios (nombre, usuario, clave, rol, estado) VALUES (?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $usuario, $clave, $rol, $estado));
                $accion = 1;
            } else {
                // Si se proporcionó un ID de usuario, se actualiza el usuario existente
                if (empty($_POST['clave'])) {
                    $sqlUpdate = 'UPDATE usuarios SET nombre = ?,usuario = ?,rol = ?,estado = ? WHERE usuario_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $usuario, $rol, $estado, $idusuario));
                    $accion = 2;
                } else {
                    $claveUpdate = password_hash($_POST['clave'], PASSWORD_DEFAULT);
                    $sqlUpdate = 'UPDATE usuarios SET nombre = ?,usuario = ?,clave = ?,rol = ?,estado = ? WHERE usuario_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $usuario, $claveUpdate, $rol, $estado, $idusuario));
                    $accion = 3;
                }
            }
            // Verifica si la consulta se ejecutó correctamente
            if ($request > 0) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'Usuario creado correctamente');
                } else {
                    $respuesta = array('status' => true, 'msg' => 'Usuario actualizado correctamente');
                }
            }
        }
    }
    // Devuelve la respuesta en formato JSON
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
