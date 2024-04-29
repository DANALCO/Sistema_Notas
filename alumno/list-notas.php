<?php
// Verifica si se proporcionó el parámetro 'curso' en la URL
if (!empty($_GET['curso'])) {
    $curso = $_GET['curso'];
} else {
    // Si no se proporcionó, redirige a la página actual (previene acceso no autorizado)
    header("Location: ./");
}

require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';

// Obtiene el ID del alumno almacenado en la sesión y lo convierte a entero
$idalumno = intval($_SESSION['alumno_id']);

// Consulta SQL para obtener las evaluaciones y notas asociadas al curso
$sql = "SELECT ev.titulo, IFNULL(n.valor_nota, 0) AS valor_nota FROM evaluaciones AS ev LEFT JOIN ev_entregadas AS ev_e ON ev.evaluacion_id = ev_e.evaluacion_id AND ev_e.alumno_id = :alumno LEFT JOIN notas AS n ON ev_e.ev_entregada_id = n.ev_entregada_id INNER JOIN contenidos AS c ON ev.contenido_id = c.contenido_id INNER JOIN profesor_materia AS pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = :curso";

$query = $pdo->prepare($sql);
// Asigna valores a los parámetros de la consulta SQL
$query->bindParam(':alumno', $idalumno, PDO::PARAM_INT);
$query->bindParam(':curso', $curso, PDO::PARAM_INT);
$query->execute();

// Obtiene el número de filas de resultados de la consulta
$row = $query->rowCount();
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
                                    <th>EVALUACION</th>
                                    <th>NOTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php // Verifica si se obtuvieron resultados de la consulta 
                                if ($row > 0) {
                                    // Itera sobre cada fila de resultados obtenidos
                                    while ($data = $query->fetch()) {
                                ?>
                                        <tr>
                                            <td><?= $data['titulo'] ?></td>
                                            <td><?= $data['valor_nota'] ?></td>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="bs-component">
                <ul class="list-group">
                    <li class="list-group-item"><span class="tag tag-default tag-pill float-xs-right">
                            <strong>
                                PROMEDIO: <?= $promedio = formato(promedioMateria($idalumno, $curso)); ?>
                                <?php 
                                // Muestra una etiqueta (badge) según el promedio obtenido
                                if($promedio < 3){
                                    echo '<kbd class="badge badge-danger">PELIGRO</kbd>';
                                }
                                else if($promedio < 4){
                                    echo '<kbd class="badge badge-medio">REGULAR</kbd>';
                                }
                                else{
                                    echo '<kbd class="badge badge-success">BIEN</kbd>';
                                }
                                ?>
                            </strong></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <a href="index.php?curso=<?= $curso ?>" class="btn btn-info">
            << Volver Atras</a>
    </div>
</main>
<?php
// Incluye el pie de página
require_once 'includes/footer.php';
?>