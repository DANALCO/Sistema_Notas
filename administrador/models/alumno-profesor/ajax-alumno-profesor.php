<?php
// Incluye el archivo de conexión a la base de datos
require_once '../../../includes/conexion.php';

// Verifica si el arreglo POST no está vacío
if (!empty($_POST)) {
    // Verifica si los campos 'listAlumno' y 'listProfesor' están vacíos
    if (empty($_POST['listAlumno']) || empty($_POST['listProfesor'])) {
        // Si alguno de los campos está vacío, se asigna un mensaje de error al arreglo de respuesta
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asignación de valores provenientes del arreglo POST a variables
        $idalumnoprofesor = $_POST['idalumnoprofesor'];
        $profesor = $_POST['listProfesor'];
        $alumno = $_POST['listAlumno'];
        $status = $_POST['listEstado'];

        // Consulta SQL para verificar si ya existe una relación alumno-profesor con los mismos valores
        $sql = "SELECT * FROM alumno_profesor WHERE alumno_id = ? AND pm_id = ? AND estadoap != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($alumno, $profesor));
        $resultInsert = $query->fetch(PDO::FETCH_ASSOC);

        // Consulta SQL para verificar si ya existe una relación alumno-profesor excluyendo un id específico
        $sql2 = "SELECT * FROM alumno_profesor WHERE alumno_id = ? AND pm_id = ? AND estadoap != 0 AND ap_id != ?";
        $query2 = $pdo->prepare($sql2);
        $query2->execute(array($alumno, $profesor, $idalumnoprofesor));
        $resultUpdate = $query2->fetch(PDO::FETCH_ASSOC);

        // Verifica si ya existe una relación alumno-profesor con los mismos valores (para inserción)
        if ($resultInsert > 0) {
            $arrResponse = array('status' => false, 'msg' => 'El alumno ya tiene el grado y el profesor asignado, seleccione otro');
        } else {
            // Si el id de la relación es vacío, procede con la inserción de un nuevo registro
            if ($idalumnoprofesor == '') {
                $sql_insert = "INSERT INTO alumno_profesor (alumno_id,pm_id,estadoap) VALUES (?,?,?)";
                $query_insert = $pdo->prepare($sql_insert);
                $request = $query_insert->execute(array($alumno, $profesor, $status));
                if ($request) {
                    $arrResponse = array('status' => true, 'msg' => 'Proceso creado correctamente');
                }
            }
        }
        // Verifica si ya existe una relación alumno-profesor con los mismos valores (para actualización)
        if ($resultUpdate > 0) {
            $arrResponse = array('status' => false, 'msg' => 'El alumno ya tiene el grado y el profesor asignado, seleccione otro');
        } else {
            // Si el id de la relación es mayor que cero, procede con la actualización del registro existente
            if ($idalumnoprofesor > 0) {
                $sql_update = "UPDATE alumno_profesor SET alumno_id = ?,pm_id = ?,estadoap = ? WHERE ap_id = ?";
                $query_update = $pdo->prepare($sql_update);
                $request2 = $query_update->execute(array($alumno, $profesor, $status, $idalumnoprofesor));
                if ($request2) {
                    $arrResponse = array('status' => true, 'msg' => 'Proceso actualizado correctamente');
                }
            }
        }
    }
    // Convierte el arreglo de respuesta a formato JSON y lo imprime en la salida
    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}
