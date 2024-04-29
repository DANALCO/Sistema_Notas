<?php
// Incluir el archivo de conexión a la base de datos
require '../../../includes/conexion.php';
// Verificar si se recibieron datos por método GET
if (!empty($_GET)) {
    $idcontenido = $_GET['idcontenido']; // Obtener el idcontenido enviado por GET
    // Consultar los detalles del contenido usando el idcontenido recibido
    $sql = "SELECT * FROM contenidos WHERE contenido_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idcontenido));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    // Verificar si se encontraron datos correspondientes al idcontenido
    if (empty($result)) {
        // Si no se encontraron datos, preparar una respuesta indicando que no se encontraron datos
        $respuesta = array('status' => false, 'msg' > 'datos no encontrados');
    } else {
        // Si se encontraron datos, preparar una respuesta con el estado true y los datos del contenido
        $respuesta = array('status' => true, 'data' => $result);
    }
    // Devolver la respuesta al cliente en formato JSON
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
