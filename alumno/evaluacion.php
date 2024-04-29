<?php
// Verifica si se proporcionaron los parámetros 'curso' y 'contenido' a través de la URL
if (!empty($_GET['curso']) || empty($_GET['contenido'])) {
    $curso = $_GET['curso'];
    $contenido = $_GET['contenido'];
} else {
    // Si falta alguno de estos parámetros, redirige al usuario a la página principal
    header("Location: ./");
}
require_once 'includes/header.php';
require_once '../includes/conexion.php';

// Obtiene el ID del alumno almacenado en la sesión y lo convierte a entero
$idAlumno = intval($_SESSION['alumno_id']);

// Consulta SQL para obtener todas las evaluaciones asociadas a un contenido específico
$sql = "SELECT *,date_format(fecha, '%d/%m/%u') as fecha FROM evaluaciones WHERE contenido_id = $contenido";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount(); // Cuenta el número de filas de resultados obtenidos
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Ver Evaluación</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Ver Evaluación</a></li>
        </ul>
    </div>
    <div class="row">
        <?php // Si se obtuvieron evaluaciones asociadas al contenido, procede a mostrarlas en la página 
        if ($row > 0) {
            while ($data = $query->fetch()) {
                // Consulta para verificar si el estudiante realizó la entrega de esta evaluación
                $sql_entrega = "SELECT * FROM ev_entregadas WHERE evaluacion_id = ? AND alumno_id = ?";
                $query_entrega = $pdo->prepare($sql_entrega);
                $query_entrega->execute([$data['evaluacion_id'], $idAlumno]);
                $entrega_realizada = $query_entrega->rowCount() > 0;

                // Determinar el texto y el enlace del botón según si se realizó la entrega o no
                $btn_text = $entrega_realizada ? 'Ver Entrega' : 'Realizar Entrega';
                $btn_link = $entrega_realizada ? 'entregas.php?curso=' . $curso . '&contenido=' . $data['contenido_id'] . '&eva=' . $data['evaluacion_id'] : 'entregas.php?curso=' . $curso . '&contenido=' . $data['contenido_id'] . '&eva=' . $data['evaluacion_id'];
        ?>
                <div class="col-md-12">
                    <div class="tile">
                        <div class="title-title-w-btn">
                            <h3 class="title"><?= $data['titulo']; ?></h3>
                            <p>
                                <!-- Enlace que redirige a la página de entregas según el estado de la evaluación -->
                                <a class="btn btn-primary" href="<?= $btn_link ?>"><i class="fa fa-edit"></i> <?= $btn_text ?></a>
                            </p>
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
        <!-- Enlace para volver atrás a la página de contenido -->
        <a href="contenido.php?curso=<?= $curso ?>" class="btn btn-info">
            << Volver Atras</a>
    </div>
</main>

<?php
require_once 'includes/footer.php';
?>
