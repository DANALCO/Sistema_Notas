<?php
// Incluye el archivo de conexión a la base de datos
require_once '../../../includes/conexion.php';

// Verifica si se recibieron datos por POST
if(!empty($_POST)) {
    // Verifica si el campo de observación está vacío o si no se adjuntó ningún archivo
    if(trim($_POST['observacion']) == '' || empty($_FILES['file'])) {
        // Crea una respuesta con un mensaje de error si faltan campos
        $respuesta = array('status' => false,'msg' => 'Todos los campos son necesarios');
    } else{
        // Obtiene los datos recibidos por POST
        $idevaluacion = $_POST['idevaluacion'];
        $idalumno = $_POST['idalumno'];
        $observacion = $_POST['observacion'];
        
        // Obtiene información del archivo adjunto
        $material = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $url_temp = $_FILES['file']['tmp_name'];
        
        // Crea un directorio para almacenar el archivo en la ruta 'uploads/' con un nombre aleatorio
        $directorio = '../../../uploads/'.rand(1000,10000);
        if(!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        
        // Establece la ruta de destino para mover el archivo
        $destino = $directorio.'/'.$material;
        
        // Verifica el tamaño del archivo (máximo 15 MB)
        if($_FILES['file']['size'] > 15000000) {
            // Crea una respuesta con un mensaje de error si el archivo excede el tamaño permitido
            $respuesta = array('status' => false, 'msg' => 'Solo se permiten archivos hasta 15MB');
        } else {
            // Prepara y ejecuta la consulta SQL para insertar los datos en la base de datos
            $sqlInsert = 'INSERT INTO ev_entregadas (evaluacion_id,alumno_id,material_alumno,observacion) VALUES (?,?,?,?)';
            $queryInsert = $pdo->prepare($sqlInsert);
            $request = $queryInsert->execute(array($idevaluacion,$idalumno,$destino,$observacion));
                // Mueve el archivo desde la ubicación temporal a la ubicación de destino
                move_uploaded_file($url_temp,$destino);
            // Verifica si la consulta fue exitosa
            if($request > 0) {
                // Crea una respuesta con un mensaje de éxito
                $respuesta = array('status' => true, 'msg' => 'Evaluacion enviada correctamente');
            }
        }
    }
    // Convierte la respuesta a formato JSON y la imprime
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}