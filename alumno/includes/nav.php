<?php
require_once '../includes/conexion.php';

$idAlumno = $_SESSION['alumno_id'];

$sql = "SELECT * FROM alumno_profesor as ap INNER JOIN alumnos as al ON ap.alumno_id = al.alumno_id INNER JOIN profesor_materia as pm ON ap.pm_id = pm.pm_id INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE al.alumno_id = $idAlumno";
$query = $pdo->prepare($sql);
$query->execute();
$row = $query->rowCount();

$sqln = "SELECT * FROM alumno_profesor as ap INNER JOIN alumnos as al ON ap.alumno_id = al.alumno_id INNER JOIN profesor_materia as pm ON ap.pm_id = pm.pm_id INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE al.alumno_id = $idAlumno";
$queryn = $pdo->prepare($sqln);
$queryn->execute();
$rown = $queryn->rowCount();


?>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/estudiante.png" alt="User Image">
    <div>
      <p class="app-sidebar__user-name"><?= $_SESSION['nombre']; ?> </p>
      <p class="app-sidebar__user-designation">Alumno</p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item" href="index.php"><i class="fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Inicio</span></a></li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="fa-solid fa-book-open" style="color: #ffffff;"></i>
        <span class="app-menu__label">Mis Clases</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <?php if ($row > 0) {
          while ($data = $query->fetch()) {
        ?>
            <li><a class="treeview-item" href="contenido.php?curso=<?= $data['pm_id'] ?>"><i class="fa-solid fa-bookmark" style="color: #ffffff;margin-right: 8px"></i><?= $data['nombre_materia']; ?> - <?= $data['nombre_grado']; ?> - <?= $data['nombre_aula'] ?></a></li>
        <?php
          }
        } ?>
      </ul>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
      <i class="fa-solid fa-book-bookmark" style="color: #ffffff;"></i>
        <span class="app-menu__label">Mis Notas</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <?php if($rown > 0) {
          while($datan = $queryn->fetch()){
        ?>
        <li><a class="treeview-item" href="list-notas.php?curso=<?= $datan['pm_id'] ?>"><i class="fa-solid fa-bookmark" style="color: #ffffff;margin-right: 8px"></i><?= $datan['nombre_materia']; ?> - <?= $datan['nombre_grado']; ?> - <?= $datan['nombre_aula'] ?></a></li>
        <?php
          }
        }?>
      </ul>
    </li>
    <li><a class="app-menu__item" href="general.php"><i class="fa-brands fa-readme" style="color: #ffffff;"></i><span class="app-menu__label">Reporte General</span></a></li>
    <li><a class="app-menu__item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Logout</span></a></li>
  </ul>
</aside>