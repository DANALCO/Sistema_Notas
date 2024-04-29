<?php
// Verifica si se han proporcionado los parámetros 'curso', 'contenido', y 'eva' a través de GET
if(!empty($_GET['curso']) || !empty($_GET['contenido'])) {
    $curso = $_GET['curso'];
    $contenido = $_GET['contenido'];
    $evaluacion = $_GET['eva'];
} else {
    // Si falta alguno de los parámetros requeridos, redirige al usuario a la página principal
    header("Location: ./");
}
// Incluye el encabezado de la página
require_once 'includes/header.php';
require_once '../includes/conexion.php';

// Obtiene el ID del alumno almacenado en la sesión
$idAlumno = $_SESSION['alumno_id'];

// Consulta SQL para verificar si el alumno ya realizó la entrega de esta evaluación
$sqla = "SELECT * FROM ev_entregadas as ev INNER JOIN alumnos as a ON ev.alumno_id = a.alumno_id INNER JOIN evaluaciones as eva ON ev.evaluacion_id = eva.evaluacion_id INNER JOIN contenidos as c ON eva.contenido_id = c.contenido_id WHERE ev.evaluacion_id = ? AND a.alumno_id = ?";
$querya = $pdo->prepare($sqla);
$querya->execute(array($evaluacion,$idAlumno));
$rowa = $querya->rowCount();

// Obtiene la fecha actual
date_default_timezone_set("America/Bogota");
$fecha = date('Y-m-d');

// Consulta SQL para obtener la fecha límite de la evaluación actual
$sqlf = "SELECT * FROM evaluaciones WHERE contenido_id = $contenido AND evaluacion_id = $evaluacion";
$queryf = $pdo->prepare($sqlf);
$queryf->execute();
$result = $queryf->fetch();
$fechaLimite = $result['fecha'];

?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Realizar Entrega</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Realizar Entrega</a></li>
        </ul>
    </div>
        <?php // Si el alumno ya realizó la entrega de esta evaluación, muestra un mensaje informativo
            if ($rowa > 0) {
            while ($data = $querya->fetch()) {
                $valor = '';
                $calificacion = '';
                $ev_entregada = $data['ev_entregada_id'];

                // Consulta SQL para verificar si la entrega fue calificada
                $sqln = "SELECT * FROM notas as n INNER JOIN ev_entregadas as ev ON n.ev_entregada_id = ev.ev_entregada_id INNER JOIN alumnos as a ON ev.alumno_id = a.alumno_id WHERE n.ev_entregada_id = $ev_entregada AND a.alumno_id = $idAlumno";
                $queryn = $pdo->prepare($sqln);
                $queryn->execute();
                $datan = $queryn->rowCount();
                $nota = $queryn->fetch();
                 // Establece el valor y la calificación según el estado de la entrega
                if ($datan > 0) {
                    $valor = '<kbd class="bg-success">Calificado</kbd>';
                    $calificacion = $nota['valor_nota'];
                } else {
                    $valor = '<kbd class="bg-danger">Sin Calificar</kbd>';
                    $calificacion = '';
                }
        ?>
        <!-- Mensaje de entrega realizada -->
        <div class="row mt-2 bg-success text-white p-2">
            <h3>Ya realizo la entrega</h3>
        </div>
        <!-- Tabla con el estado de la entrega y la calificación (si está calificada) -->
        <div class="row mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Estatus</th>
                        <th>Calificacion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><p><?= $valor; ?></p></td>
                        <td><p><?= $calificacion; ?></p></td>
                    </tr>
                </tbody>
            </table>
        </div>   

        <?php } } else{ ?>
            <?php // Si la fecha actual es anterior a la fecha límite, muestra el formulario para realizar la entrega
                if($fecha < $fechaLimite) { ?>
                <div class="row">
                    <div class="col-md-12">
                    <div class="tile">
            <h3 class="tile-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Realizar Entrega</font></font></h3>
            <div class="tile-body">
                <!-- Formulario para realizar la entrega -->
              <form class="form-horizontal" id="formEntrega" name="formEntrega" enctype="multipart/form-data">
                <input type="hidden" name="idevaluacion" id="idevaluacion" value="<?= $evaluacion; ?>">
                <input type="hidden" name="idalumno" id="idalumno" value="<?= $idAlumno; ?>">
                <div class="mb-3 row">
                  <label class="form-label col-md-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Descripcion de la Actividad</font></font></label>
                  <div class="col-md-8">
                    <textarea class="form-control" name="observacion" id="observacion" rows="4" placeholder="Descripcion de la Actividad"></textarea>
                  </div>
                </div>
                <div class="mb-3 row">
                    <label class="control-label col-md-3">Adjuntar Material</label>
                  <div class="col-md-8">
                    <input type="file" class="form-control" name="file" id="file"></input>
                  </div>
                </div>
                <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="submit"><i class="bi bi-check-circle-fill me-2"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Enviar</font></font></button>
                </div>
              </div>
            </div>
              </form>
            </div>
          </div>
                    </div>
                </div>

            <?php } else { // Si la fecha actual es posterior a la fecha límite, muestra un mensaje de advertencia?>
                <div class="row bg-danger p-3 text-white">
                    <h5>Ya no se puede hacer entregas (Fecha limite <?= $fechaLimite; ?>)</h5>
                </div>
            <?php } ?>
        <?php } ?>

    <div class="row">
        <!-- Enlace para volver atrás -->
        <a href="evaluacion.php?curso=<?= $curso ?>&contenido=<?= $contenido ?>" class="btn btn-info"><< Volver Atras</a>
    </div>
</main>
<?php
require_once 'includes/footer.php';
?>
<!-- Incluye el script para el manejo de la entrega (envío del formulario) -->
<script type="text/javascript" src="js/functions-entrega.js"></script>