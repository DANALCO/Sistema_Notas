<?php
// Verifica si se recibió un parámetro 'curso' a través de GET
if (!empty($_GET['curso'])) {
    $curso = $_GET['curso'];
} else {
    // Si no se proporciona el parámetro 'curso', redirige al usuario a la página principal
    header("Location: ./");
}

// Incluye el encabezado de la página
// Incluye archivos necesarios (como conexiones a la base de datos y funciones personalizadas)
require_once 'includes/header.php';
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';

// Obtiene el ID del alumno desde la sesión (previamente iniciada)
$idAlumno = intval($_SESSION['alumno_id']);

// Construye la consulta SQL para seleccionar los contenidos asociados al curso específico
$sql = "SELECT * FROM contenidos as c INNER JOIN profesor_materia as pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = $curso";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount(); // Obtiene el número de filas afectadas por la consulta
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Contenidos A Evaluar</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Contenidos A Evaluar</a></li>
        </ul>
    </div>
    <div class="row">
        <?php if ($row > 0) {
            // Itera sobre los resultados de la consulta
            while ($data = $query->fetch()) {
        ?>
                <div class="col-md-12">
                    <div class="tile">
                        <div class="title-title-w-btn">
                            <h3 class="title"><?= $data['titulo']; ?></h3>
                            <!-- Enlace para ver las evaluaciones asociadas a este contenido -->
                            <p>
                                <a class="btn btn-primary" href="evaluacion.php?curso=<?= $data['pm_id']; ?>&contenido=<?= $data['contenido_id']; ?>"><i class="fa fa-edit"></i>Ver Evaluaciones</a>
                            </p>
                        </div>
                        <div class="title-body">
                            <b><?= $data['descripcion']; ?></b>
                        </div>
                        <div class="title-footer mt-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-download"></i></div>
                                </div>
                                <!-- Enlace para descargar el material asociado a este contenido -->
                                <a class="btn btn-primary" href="BASE_URL<?= $data['material']; ?>" target="_blank"> Material De Descarga</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } ?>
    </div>
    <div class="row">
        <!-- Enlace para regresar a la página principal -->
        <a href="./index.php" class="btn btn-info">
            << Volver Atras</a>
    </div>
</main>
<?php
// Incluye el pie de página
require_once 'includes/footer.php';
?>