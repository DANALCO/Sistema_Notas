<<<<<<< HEAD
<?php
require_once '../../../includes/conexion.php';

if($_POST){
    $idprofesor = $_POST['idprofesor'];

    $sql = "UPDATE profesor SET estado = 0 WHERE profesor_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprofesor));

    if($result){
        $respuesta = array('status' => true,'msg' => 'Profesor eliminado correctamente');
    }else{
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
=======
<<<<<<< HEAD
<<<<<<< HEAD
<?php
require_once '../../../includes/conexion.php';

if($_POST){
    $idprofesor = $_POST['idprofesor'];

    $sql = "UPDATE profesor SET estado = 0 WHERE profesor_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprofesor));

    if($result){
        $respuesta = array('status' => true,'msg' => 'Profesor eliminado correctamente');
    }else{
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
=======
<?php
require_once '../../../includes/conexion.php';

if($_POST){
    $idprofesor = $_POST['idprofesor'];

    $sql = "UPDATE profesor SET estado = 0 WHERE profesor_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprofesor));

    if($result){
        $respuesta = array('status' => true,'msg' => 'Profesor eliminado correctamente');
    }else{
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
=======
<?php
require_once '../../../includes/conexion.php';

if($_POST){
    $idprofesor = $_POST['idprofesor'];

    $sql = "UPDATE profesor SET estado = 0 WHERE profesor_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprofesor));

    if($result){
        $respuesta = array('status' => true,'msg' => 'Profesor eliminado correctamente');
    }else{
        $respuesta = array('status' => false,'msg' => 'Error al eliminar');
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
>>>>>>> ebccd87b7d06dca01d7c509e93888b1f9b88a962
>>>>>>> main
}