<?php
// Verificar si se recibió el parámetro 'curso' en la URL
if(!empty($_GET['curso'])){
    $curso = $_GET['curso'];// Obtener el ID del curso desde la URL
}else{
    header("Location: ./");// Redirigir a la página principal si no se proporciona el ID del curso
}
// Incluir el archivo de encabezado y la conexión a la base de datos
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
// Obtener el ID del profesor desde la sesión
    $idprofesor = intval($_SESSION['profesor_id']);
// Consulta SQL para obtener la lista de alumnos asociados al curso específico
    $sql = "SELECT * FROM alumno_profesor as ap INNER JOIN profesor_materia as pm ON ap.pm_id = pm.pm_id INNER JOIN alumnos as a ON ap.alumno_id = a.alumno_id WHERE pm.pm_id = $curso";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();// Contar el número de filas obtenidas en la consulta
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Lista De Alumnos</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">lista de alumnos</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablealumnos">
                        <thead>
                            <tr>
                            <th>ALUMNO</th>
                            <th>CEDULA</th>
                            <th>ULTIMO ACCESO AL SISTEMA</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if($row > 0) {
                            while($data = $query->fetch()){
                                $codAlumno = $data['alumno_id'];
                                // Consulta SQL para obtener la última fecha de acceso del alumno
                                $sql_acceso = "SELECT u_acceso FROM alumnos WHERE alumno_id = $codAlumno";
                                $querry_acceso = $pdo->prepare($sql_acceso);
                                $querry_acceso->execute();
                                $res_acceso = $querry_acceso->fetch();
                        ?>
                                <tr>
                                    <td><?= $data['nombre_alumno']?></td>
                                    <td><?= $data['cedula']?></td>
                                    <td>
                                        <?php
                                        // Mostrar la fecha de último acceso o indicar 'NUNCA' si nunca ha accedido
                                        if($res_acceso['u_acceso'] == null){
                                            echo '<kbd class="badge badge-danger">NUNCA</kbd>';
                                        }else{
                                            echo $res_acceso['u_acceso'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <a href="./index.php" class="btn btn-info"><< Volver Atras</a>
    </div>
</main>
<?php
    require_once 'includes/footer.php';
?>