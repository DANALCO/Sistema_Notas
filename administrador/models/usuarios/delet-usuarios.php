<?php
// Requiere el archivo de conexión
require_once '../../../includes/conexion.php';

// Verifica si se recibieron datos por POST
if ($_POST) {
    // Obtiene el ID de usuario a eliminar
    $idusuario = $_POST['idusuario'];

    // Prepara y ejecuta la consulta para actualizar el estado del usuario
    $sql = "UPDATE usuarios SET estado = 0 WHERE usuario_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idusuario));
    // Verifica si la actualización se realizó correctamente
    if ($result) {
        $respuesta = array('status' => true, 'msg' => 'Usuario eliminado correctamente');
    } else {
        $respuesta = array('status' => false, 'msg' => 'Error al eliminar');
    }
    // Devuelve la respuesta en formato JSON
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
