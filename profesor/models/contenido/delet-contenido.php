<?php
// Incluir el archivo de conexión a la base de datos
require_once '../../../includes/conexion.php';
// Verificar si se recibieron datos por método POST
if ($_POST) {
    $idcontenido = $_POST['idcontenido']; // Obtener el idcontenido enviado por POST
    // Consultar el contenido correspondiente al idcontenido recibido
    $sql = "SELECT * FROM contenidos WHERE contenido_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idcontenido));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    // Consultar evaluaciones asociadas al contenido para verificar si existen
    $sqle = "SELECT * FROM evaluaciones WHERE contenido_id = ?";
    $querye = $pdo->prepare($sqle);
    $querye->execute(array($idcontenido));
    $data2 = $querye->fetch(PDO::FETCH_ASSOC);
    // Verificar si no existen evaluaciones asociadas al contenido
    if (empty($data2)) {
        // Si no hay evaluaciones asociadas, proceder con la eliminación del contenido
        $sql_update = "DELETE FROM contenidos WHERE contenido_id = ?";
        $query_update = $pdo->prepare($sql_update);
        $result = $query_update->execute(array($idcontenido));
        if ($result) {
            // Si la eliminación se realizó con éxito, eliminar también el archivo asociado (si existe)
            if ($data['material'] != '') {
                unlink($data['material']); // Eliminar archivo del servidor
            }
            $arrResponse = array('status' => true, 'msg' => 'Eliminado correctamente');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
        }
    } else {
        // Si existen evaluaciones asociadas al contenido, enviar mensaje de error
        $arrResponse = array('status' => false, 'msg' => 'No se puede eliminar, ya tiene evaluacion asignada');
    }
    // Devolver la respuesta al cliente en formato JSON
    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}
