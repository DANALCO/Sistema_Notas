<?php
// Requiere el archivo de conexión
require '../../../includes/conexion.php';
// Verifica si se recibió un parámetro GET
if (!empty($_GET)) {
    // Obtiene el ID de usuario de los parámetros GET
    $idusuario = $_GET['idusuario'];
    // Prepara y ejecuta la consulta para obtener los datos del usuario por su ID
    $sql = "SELECT * FROM usuarios WHERE usuario_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idusuario));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    // Verifica si se encontraron datos para el ID proporcionado
    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'datos no encontrados');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }
    // Devuelve la respuesta en formato JSON
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
