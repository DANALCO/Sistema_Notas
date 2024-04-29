<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';

// Obtiene el ID del alumno almacenado en la sesión y lo convierte a un entero
$idalumno = intval($_SESSION['alumno_id']);

// Consulta SQL para obtener la información de las materias asociadas al alumno
$sql = "SELECT * FROM alumno_profesor as ap INNER JOIN alumnos as al ON ap.alumno_id = al.alumno_id INNER JOIN profesor_materia as pm ON ap.pm_id = pm.pm_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE al.alumno_id = $idAlumno";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount(); // Cuenta el número de filas de resultados obtenidos
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Notas Cargadas</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Notas Cargadas</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="title-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>MATERIA</th>
                                    <th>PROMEDIO</th>
                                    <th>VER GENERAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php // Verifica si se obtuvieron resultados de la consulta
                                 if ($row > 0) {
                                    // Itera sobre cada resultado de la consulta
                                    while ($data = $query->fetch()) {
                                ?>
                                        <tr>
                                            <td><?= $data['nombre_materia'] ?></td>
                                            <td>
                                                <?= $promedio = formato(promedioMateria($idalumno, $data['pm_id']))// Obtiene el promedio de la materia actual ?>
                                                <?php // Muestra el promedio con formato y una etiqueta de estado según el valor del promedio
                                                if ($promedio < 3) {
                                                    echo '<kbd class="badge badge-danger" style="margin-left: 10px;">PELIGRO</kbd>';
                                                } else if ($promedio < 4) {
                                                    echo '<kbd class="badge badge-medio" style="margin-left: 10px;">REGULAR</kbd>';
                                                } else {
                                                    echo '<kbd class="badge badge-success" style="margin-left: 10px;">BIEN</kbd>';
                                                }
                                                ?>
                                            </td>
                                            <!-- Enlace para ver las notas detalladas de la materia -->
                                            <td><a href="list-notas.php?curso=<?= $data['pm_id'] ?>" class="btn btn-primary">Ver Notas</a></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Enlace para volver atrás a la página principal -->
    <div class="row mt-3">
        <a href="index.php?curso=<?= $curso ?>" class="btn btn-info">
            << Volver Atras</a>
    </div>
</main>
<?php
require_once 'includes/footer.php';
?>