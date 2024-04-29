<?php
// Incluye el encabezado de la página y el archivo de conexión a la base de datos
require_once 'includes/header.php';
require_once '../includes/conexion.php';
// Obtiene el ID del profesor de la sesión actual y lo convierte a entero
$idprofesor = intval($_SESSION['profesor_id']);

// Prepara y ejecuta una consulta SQL para obtener los cursos asociados al profesor
$sql = "SELECT * FROM profesor_materia as pm INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm != 0 AND pm.profesor_id = $idprofesor";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();

?>

<main class="app-content">

    <div class="row">
        <div class="col-md-12 text-center border p-4" style="background-color: #198754;">
            <h4 class="custom-text" style="font-size: 24px;">Mis Cursos</h4>
        </div>
    </div>
    <div class="col text-center border mt-3 p-4 bg-light">
        <div class="row row-cols">
            <?php
            // Verifica si se encontraron cursos asociados al profesor
            if ($row > 0) {
                while ($data = $query->fetch()) {
            ?>
                    <div class="col mb-4">
                        <div class="card shadow" style="width: 22rem;">
                            <img src="images/curso.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4 class="card-title text-center"><?= $data['nombre_materia'] ?></h4>
                                <h5 class="card-title">Grado <kbd class="bg-custom"><?= $data['nombre_grado'] ?></kbd> - Aula <kbd class="bg-custom"><?= $data['nombre_aula'] ?></kbd></h5>
                                <!-- Botones de acción para acceder al contenido del curso y ver los alumnos -->
                                <a href="contenido.php?curso=<?= $data['pm_id'] ?>" class="btn btn-primary">Acceder</a>
                                <a href="alumnos.php?curso=<?= $data['pm_id'] ?>" class="btn btn-warning">Ver Alumnos</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>


</main>
<?php
require_once 'includes/footer.php'
?>