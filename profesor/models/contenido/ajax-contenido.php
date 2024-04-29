<?php
// Incluye el archivo de conexión a la base de datos
require_once '../../../includes/conexion.php';
// Verifica si se recibieron datos por método POST
if(!empty($_POST)) {
    // Verifica si los campos 'titulo' o 'descripcion' están vacíos
    if(empty($_POST['titulo']) || empty($_POST['descripcion'])){
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Obtiene los valores recibidos por POST
        $idcontenido = $_POST['idcontenido'];
        $idcurso = $_POST['idcurso'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
// Obtiene información del archivo subido
        $material = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $url_temp = $_FILES['file']['tmp_name'];
// Directorio donde se almacenará el archivo
        $directorio = '../../../uploads/'.rand(1000,10000);
        if(!file_exists($directorio)) {
            mkdir($directorio, 0777, true);// Crea el directorio si no existe
        }
        $destino = $directorio.'/'.$material;// Ruta de destino completa para el archivo
              // Consulta la base de datos para obtener datos del contenido existente
        $sql = 'SELECT * FROM contenidos WHERE contenido_id = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($idcontenido));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        // Verifica el tamaño del archivo subido
        if($_FILES['file']['size'] > 15000000){
            $respuesta = array('status' => false, 'msg' => 'Solo se permiten archivos hasta 15MB');
        }else {
            // Si no se recibió un 'idcontenido', se inserta un nuevo contenido
            if($idcontenido == '') {
                $sqlInsert = 'INSERT INTO contenidos (titulo,descripcion,material,pm_id) VALUES (?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($titulo, $descripcion, $destino, $idcurso));
                // Mueve el archivo subido al directorio de destino
                move_uploaded_file($url_temp, $destino);
                $accion = 1;// Indica acción de creación de contenido
            } else {
                // Si se recibió un 'idcontenido', se actualiza el contenido existente
                if(empty($_FILES['file']['name'])) {
                    $sqlUpdate = 'UPDATE contenidos SET titulo = ?, descripcion =?,pm_id = ? WHERE contenido_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($titulo, $descripcion, $idcurso, $idcontenido));
                    $accion = 2;// Indica acción de actualización de contenido sin archivo
                } else {
                    $sqlUpdate = 'UPDATE contenidos SET titulo = ?, descripcion = ?, material = ?, pm_id = ? WHERE contenido_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($titulo, $descripcion, $destino, $idcurso, $idcontenido));
                    // Elimina el archivo anterior si existe y se ha subido un nuevo archivo
                    if($data['material'] != '') {
                        unlink($data['material']);// Elimina el archivo anterior del servidor
                    }
                    // Mueve el nuevo archivo subido al directorio de destino
                    move_uploaded_file($url_temp, $destino);
                    $accion = 3;// Indica acción de actualización de contenido con nuevo archivo
                }
            } 
            // Verifica si la consulta se ejecutó correctamente
            if ($request > 0) {
                if($accion==1) {
                    $respuesta = array('status' => true, 'msg' => 'Contenido creado correctamente');
                } else {
                    $respuesta = array('status' => true, 'msg' => 'Contenido actualizado correctamente');
                }
            }
        }  
    }   
    // Devuelve la respuesta en formato JSON al cliente
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
