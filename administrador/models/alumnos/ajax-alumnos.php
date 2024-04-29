<<<<<<< HEAD
<?php
require_once '../../../includes/conexion.php';
if(!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['cedula']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['fecha_nac'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        $idalumno = $_POST['idalumno'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $direccion = $_POST['direccion'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $fecha_nac = $_POST['fecha_nac'];
        $fecha_reg = $_POST['fecha_reg'];
        $estado = $_POST['listEstado'];

        $sql = 'SELECT * FROM alumnos WHERE cedula = ? AND alumno_id != ? AND estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula,$idalumno));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El alumno ya existe');
        } else {
            if($idalumno == '') {
                $sqlInsert = 'INSERT INTO alumnos (nombre_alumno,edad, direccion, cedula, telefono, correo, fecha_nac, fecha_registro, estado) VALUES (?,?,?,?,?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$edad, $direccion, $cedula, $telefono, $correo, $fecha_nac, $fecha_reg, $estado));
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE alumnos SET nombre_alumno = ?,edad = ?,direccion = ?,cedula = ?,telefono = ?,correo = ?,fecha_nac = ?, fecha_registro = ?, estado = ? WHERE alumno_id = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre, $edad, $direccion, $cedula, $telefono, $correo, $fecha_nac, $fecha_reg, $estado, $idalumno));
                $accion = 2;
            }            

            if ($request > 0) {
                if($accion == 1){
                    $respuesta = array('status' => true, 'msg' => 'Alumno creado correctamente');
                }else{
                    $respuesta = array('status' => true, 'msg' => 'Alumno actualizado correctamente');
                }
            } 
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
=======
<<<<<<< HEAD
<<<<<<< HEAD
<?php
require_once '../../../includes/conexion.php';
if(!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['cedula']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['fecha_nac'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        $idalumno = $_POST['idalumno'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $direccion = $_POST['direccion'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $fecha_nac = $_POST['fecha_nac'];
        $fecha_reg = $_POST['fecha_reg'];
        $estado = $_POST['listEstado'];

        $sql = 'SELECT * FROM alumnos WHERE cedula = ? AND alumno_id != ? AND estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula,$idalumno));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El alumno ya existe');
        } else {
            if($idalumno == '') {
                $clave = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                $sqlInsert = 'INSERT INTO alumnos (nombre_alumno,edad, direccion, cedula, clave, telefono, correo, fecha_nac, fecha_registro, estado) VALUES (?,?,?,?,?,?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$edad, $direccion, $cedula, $clave, $telefono, $correo, $fecha_nac, $fecha_reg, $estado));
                $accion = 1;
            } else {
                if(empty($_POST['clave'])){
                    $sqlUpdate = 'UPDATE alumnos SET nombre_alumno = ?,edad = ?,direccion = ?,cedula = ?,telefono = ?,correo = ?,fecha_nac = ?, fecha_registro = ?, estado = ? WHERE alumno_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $edad, $direccion, $cedula, $telefono, $correo, $fecha_nac, $fecha_reg, $estado, $idalumno));
                    $accion = 2;
                } else{
                    $claveUpdate = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                    $sqlUpdate = 'UPDATE alumnos SET nombre_alumno = ?,edad = ?,direccion = ?,cedula = ?,clave = ?,telefono = ?,correo = ?,fecha_nac = ?, fecha_registro = ?, estado = ? WHERE alumno_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $edad, $direccion, $cedula, $claveUpdate, $telefono, $correo, $fecha_nac, $fecha_reg, $estado, $idalumno));
                    $accion = 3;
                }
            }          

            if ($request > 0) {
                if($accion == 1){
                    $respuesta = array('status' => true, 'msg' => 'Alumno creado correctamente');
                }else{
                    $respuesta = array('status' => true, 'msg' => 'Alumno actualizado correctamente');
                }
            } 
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
=======
<?php
require_once '../../../includes/conexion.php';
if(!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['cedula']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['fecha_nac'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        $idalumno = $_POST['idalumno'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $direccion = $_POST['direccion'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $fecha_nac = $_POST['fecha_nac'];
        $fecha_reg = $_POST['fecha_reg'];
        $estado = $_POST['listEstado'];

        $sql = 'SELECT * FROM alumnos WHERE cedula = ? AND alumno_id != ? AND estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula,$idalumno));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El alumno ya existe');
        } else {
            if($idalumno == '') {
                $sqlInsert = 'INSERT INTO alumnos (nombre_alumno,edad, direccion, cedula, telefono, correo, fecha_nac, fecha_registro, estado) VALUES (?,?,?,?,?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$edad, $direccion, $cedula, $telefono, $correo, $fecha_nac, $fecha_reg, $estado));
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE alumnos SET nombre_alumno = ?,edad = ?,direccion = ?,cedula = ?,telefono = ?,correo = ?,fecha_nac = ?, fecha_registro = ?, estado = ? WHERE alumno_id = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre, $edad, $direccion, $cedula, $telefono, $correo, $fecha_nac, $fecha_reg, $estado, $idalumno));
                $accion = 2;
            }            

            if ($request > 0) {
                if($accion == 1){
                    $respuesta = array('status' => true, 'msg' => 'Alumno creado correctamente');
                }else{
                    $respuesta = array('status' => true, 'msg' => 'Alumno actualizado correctamente');
                }
            } 
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
=======
<?php
require_once '../../../includes/conexion.php';
if(!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['cedula']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['fecha_nac'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        $idalumno = $_POST['idalumno'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $direccion = $_POST['direccion'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $fecha_nac = $_POST['fecha_nac'];
        $fecha_reg = $_POST['fecha_reg'];
        $estado = $_POST['listEstado'];

        $sql = 'SELECT * FROM alumnos WHERE cedula = ? AND alumno_id != ? AND estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula,$idalumno));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El alumno ya existe');
        } else {
            if($idalumno == '') {
                $sqlInsert = 'INSERT INTO alumnos (nombre_alumno,edad, direccion, cedula, telefono, correo, fecha_nac, fecha_registro, estado) VALUES (?,?,?,?,?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$edad, $direccion, $cedula, $telefono, $correo, $fecha_nac, $fecha_reg, $estado));
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE alumnos SET nombre_alumno = ?,edad = ?,direccion = ?,cedula = ?,telefono = ?,correo = ?,fecha_nac = ?, fecha_registro = ?, estado = ? WHERE alumno_id = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre, $edad, $direccion, $cedula, $telefono, $correo, $fecha_nac, $fecha_reg, $estado, $idalumno));
                $accion = 2;
            }            

            if ($request > 0) {
                if($accion == 1){
                    $respuesta = array('status' => true, 'msg' => 'Alumno creado correctamente');
                }else{
                    $respuesta = array('status' => true, 'msg' => 'Alumno actualizado correctamente');
                }
            } 
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
>>>>>>> ebccd87b7d06dca01d7c509e93888b1f9b88a962
>>>>>>> main
}