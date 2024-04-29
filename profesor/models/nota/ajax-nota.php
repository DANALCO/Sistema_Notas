<?php
// Incluir el archivo de conexión a la base de datos
require_once '../../../includes/conexion.php';
// Verificar si se recibieron datos por método POST
if (!empty($_POST)) {
    // Obtener los datos enviados por POST
    $nota = $_POST['nota'];
    $ideventregada = $_POST['ideventregada'];

    // Verificar si la nota está dentro del rango permitido (0 a 5)
    if ($nota < 0 || $nota > 5) {
        // Preparar una respuesta con estado false y un mensaje de error
        $respuesta = array('status' => false, 'msg' => 'La nota debe estar entre 0 y 5');
    } else {
        // Preparar la consulta SQL para insertar la nueva evaluación (nota)
        $sqlInsert = 'INSERT INTO notas (ev_entregada_id, valor_nota) VALUES (?, ?)';
        $queryInsert = $pdo->prepare($sqlInsert);
        // Ejecutar la consulta SQL con los datos de la evaluación
        $request = $queryInsert->execute(array($ideventregada, $nota));
        // Verificar el resultado de la inserción
        if ($request > 0) {
            $respuesta = array('status' => true, 'msg' => 'Evaluación creada correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al crear la evaluación');
        }
    }
    // Devolver la respuesta al cliente en formato JSON
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
