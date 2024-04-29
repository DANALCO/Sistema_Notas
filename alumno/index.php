<?php
require_once 'includes/header.php';
require_once '../includes/conexion.php';

// Obtiene el ID del alumno almacenado en la sesión
$idAlumno = $_SESSION['alumno_id'];

// Consulta SQL para obtener la información de las clases del alumno
$sql = "SELECT * FROM alumno_profesor as ap INNER JOIN alumnos as al ON ap.alumno_id = al.alumno_id INNER JOIN profesor_materia as pm ON ap.pm_id = pm.pm_id INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE al.alumno_id = $idAlumno";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount(); // Cuenta el número de filas de resultados obtenidos

?>

<main class="app-content">
  <div class="row">
    <div class="col-md-12 text-center border p-4" style="background-color: #198754;">
      <h4 class="custom-text" style="font-size: 24px;">Mis Clases</h4>
    </div>
  </div>
  <div class="col text-center border mt-3 p-4 bg-light">
    <div class="row row-cols">
      <?php // Verifica si se obtuvieron resultados de la consulta 
      if ($row > 0) {
        // Itera sobre cada fila de resultados obtenidos
        while ($data = $query->fetch()) {
      ?>
          <div class="col mb-4">
            <div class="card shadow" style="width: 22rem;">
              <img src="images/curso.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <!-- Muestra el nombre de la materia -->
                <h4 class="card-title text-center"><?= $data['nombre_materia'] ?></h4>
                <!-- Muestra el grado y el aula de la materia -->
                <h5 class="card-title">Grado <kbd class="bg-custom"><?= $data['nombre_grado'] ?></kbd> - Aula <kbd class="bg-custom"><?= $data['nombre_aula'] ?></kbd></h5>
                <!-- Enlace para acceder al contenido de la materia -->
                <a href="contenido.php?curso=<?= $data['pm_id'] ?>" class="btn btn-primary"> Acceder</a>
                <!-- Enlace para ver las notas de la materia -->
                <a href="list-notas.php?curso=<?= $data['pm_id'] ?>" class="btn btn-warning">Ver Notas</a>
              </div>
            </div>
          </div>
      <?php }
      } ?>
    </div>
  </div>

</main>
<?php
require_once 'includes/footer.php'
?>