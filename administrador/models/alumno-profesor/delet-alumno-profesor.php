<?php
// Incluye el archivo de conexión a la base de datos
require_once '../../../includes/conexion.php';
// Verifica si se ha enviado algún dato mediante POST
if($_POST){
    // Obtiene el valor del parámetro 'id' enviado mediante POST
    $idalumnoprofesor = $_POST['id'];
// Prepara y ejecuta una consulta SQL para actualizar el estadoap a 0 donde ap_id sea igual al valor recibido
    $sql = "UPDATE alumno_profesor SET estadoap = 0 WHERE ap_id = ?";
    $query = $pdo->prepare($sql);// Prepara la consulta SQL
    $result = $query->execute(array($idalumnoprofesor)); // Ejecuta la consulta con el parámetro recibido

        // Verifica si la consulta se ejecutó correctamente
    if($result){
        // Si la consulta se ejecutó correctamente, se asigna un mensaje de éxito al arreglo de respuesta
        $respuesta = array('status' => true,'msg' => 'Proceso eliminado correctamente');
    }else{
        // Si hubo un error al ejecutar la consulta, se asigna un mensaje de error al arreglo de respuesta
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    // Convierte el arreglo de respuesta a formato JSON y lo imprime en la salida
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}