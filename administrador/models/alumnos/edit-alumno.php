<<<<<<< HEAD
<<<<<<< HEAD
<?php

require '../../../includes/conexion.php';

if(!empty($_GET)){
    $idalumno = $_GET['idalumno'];

    $sql = "SELECT * FROM alumnos WHERE alumno_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idalumno));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)){
        $respuesta = array('status' => false,'msg' =>'datos no encontrados');
    }else{
        $respuesta = array('status' => true,'data' => $result);
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
=======
<?php

require '../../../includes/conexion.php';

if(!empty($_GET)){
    $idalumno = $_GET['idalumno'];

    $sql = "SELECT * FROM alumnos WHERE alumno_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idalumno));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)){
        $respuesta = array('status' => false,'msg' =>'datos no encontrados');
    }else{
        $respuesta = array('status' => true,'data' => $result);
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
=======
<?php

require '../../../includes/conexion.php';

if(!empty($_GET)){
    $idalumno = $_GET['idalumno'];

    $sql = "SELECT * FROM alumnos WHERE alumno_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idalumno));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)){
        $respuesta = array('status' => false,'msg' =>'datos no encontrados');
    }else{
        $respuesta = array('status' => true,'data' => $result);
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
>>>>>>> ebccd87b7d06dca01d7c509e93888b1f9b88a962
}