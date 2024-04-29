<?php
// Verifica si los parámetros 'curso', 'contenido', y 'eva' están presentes en $_GET
if (!empty($_GET['curso']) || empty($_GET['contenido']) || empty($_GET['eva'])) {
    $curso = $_GET['curso'];// Asigna el valor del parámetro 'curso' a la variable $curso
    $contenido = $_GET['contenido'];// Asigna el valor del parámetro 'contenido' a la variable $contenido
    $evaluacion = $_GET['eva']; // Asigna el valor del parámetro 'eva' a la variable $evaluacion
} else {
    header("Location: ./");// Si falta alguno de los parámetros, redirige a la página actual (la raíz del directorio actual)
}
// Incluye los archivos necesarios
require_once 'includes/header.php';
require_once '../includes/funciones.php';
require_once '../includes/conexion.php';

// Obtiene el ID del profesor de la sesión actual y lo convierte a entero
$idprofesor = intval($_SESSION['profesor_id']);

// Prepara y ejecuta una consulta SQL para obtener la evaluación específica
$sql = "SELECT *,date_format(fecha, '%d/%m/%u') as fecha FROM evaluaciones WHERE contenido_id = $contenido AND evaluacion_id = $evaluacion";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();
// Prepara y ejecuta una consulta SQL para obtener las evaluaciones entregadas para la evaluación específica
$sqla = "SELECT * FROM ev_entregadas as ev INNER JOIN alumnos as a ON ev.alumno_id = a.alumno_id INNER JOIN evaluaciones as eva ON ev.evaluacion_id = eva.evaluacion_id INNER JOIN contenidos as c ON eva.contenido_id = c.contenido_id WHERE ev.evaluacion_id = ?";
$querya = $pdo->prepare($sqla);
$querya->execute(array($evaluacion));
$rowa = $querya->rowCount();
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Evaluaciones Entregadas</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Evaluaciones Entregadas</a></li>
        </ul>
    </div>
    <div class="row">
        <?php 
        // Verifica si se encontraron evaluaciones
        if ($row > 0) {
            while ($data = $query->fetch()) {
        ?>
                <div class="col-md-12">
                    <div class="tile">
                        <div class="title-title-w-btn">
                            <h3 class="title"><?= $data['titulo']; ?></h3>
                        </div>
                        <div class="title-body">
                            <b><?= $data['descripcion']; ?></b><br><br>
                            <b>Fecha: <kbd class="bg-custom"> <?= $data['fecha']; ?></kbd></b><br><br>
                        </div>
                    </div>
                </div>
        <?php
            }
        } ?>
    </div>
    <div class="row">
        <div class="col-md-12 text-center border p-4" style="background-color: #198754;">
            <h3 class="custom-text" style="font-size: 23px;">Evaluaciones Entregadas</h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="tile">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Alumno</th>
                            <th>Observacion</th>
                            <th>Material</th>
                            <th>Estatus</th>
                            <th>Cargar Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Verifica si se encontraron evaluaciones entregadas
                        if ($rowa > 0) {
                            while ($data2 = $querya->fetch()) {
                                $valor = '';
                                $cargar = '';
                                $alumno = $data2['alumno_id'];
                                $ev_entregada = $data2['ev_entregada_id'];
                                 // Consulta para verificar si la evaluación fue calificada
                                $sqln = "SELECT * FROM notas WHERE ev_entregada_id = $ev_entregada";
                                $queryn = $pdo->prepare($sqln);
                                $queryn->execute();
                                $datan = $queryn->rowCount();
                                // Determina el estado de la evaluación (calificada o sin calificar)
                                if ($datan > 0) {
                                    $valor = '<kbd class="bg-success">Calificado</kbd>';
                                    $cargar = '';
                                } else {
                                    require_once 'includes/modals/modal-nota.php';// Incluye un modal para cargar la nota (no especificado en el código proporcionado)
                                    $valor = '<kbd class="bg-danger">Sin Calificar</kbd>';
                                    $cargar = '<button class="btn btn-warning" onclick="modalNota()">Cargar Nota</button>';
                                }
                        ?>
                                <tr>
                                    <td><?php echo $data2['nombre_alumno']; ?></td>
                                    <td><?php echo $data2['observacion']; ?></td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="fas fa-download"></i></div>
                                        </div>
                                        <a class="btn btn-primary" href="BASE_URL<?= $data2['material_alumno']; ?>" target="_blank">Material</a>
                                    </td>
                                    <!-- Estado de la evaluación (calificado o sin calificar) -->
                                    <td><?= $valor ?></td>
                                    <!-- Botón para cargar la nota si la evaluación no está calificada -->
                                    <td><?php echo $cargar; ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <a href="evaluacion.php?curso=<?= $curso ?>&contenido=<?= $contenido ?>" class="btn btn-info">
            << Volver Atras</a>
    </div>
</main>
<?php
require_once 'includes/footer.php';
?>
<script src="js/functions-nota.js"></script>