<?php
// Incluye el archivo de conexión a la base de datos
require '../../../includes/conexion.php';

// Verifica si el array GET no está vacío
if(!empty($_GET)){
    // Obtiene el valor del parámetro 'id' enviado mediante GET
    $idalumnoprofesor= $_GET['id'];

    // Prepara y ejecuta una consulta SQL para seleccionar un registro de la tabla 'alumno_profesor' donde 'ap_id' sea igual al valor recibido
    $sql = "SELECT * FROM alumno_profesor WHERE ap_id = ?";
    $query = $pdo->prepare($sql);// Prepara la consulta SQL
    $query->execute(array($idalumnoprofesor));// Ejecuta la consulta con el parámetro recibido
    $result = $query->fetch(PDO::FETCH_ASSOC); // Obtiene el resultado de la consulta como un array asociativo

    // Verifica si no se encontraron datos en la consulta
    if(empty($result)){
        // Si no se encontraron datos, asigna un mensaje de error al arreglo de respuesta
        $respuesta = array('status' => false,'msg' =>'datos no encontrados');
    }else{
        // Si se encontraron datos, asigna un mensaje de éxito y los datos encontrados al arreglo de respuesta
        $respuesta = array('status' => true,'data' => $result);
    }
    // Convierte el arreglo de respuesta a formato JSON y lo imprime en la salida
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}