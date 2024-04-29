<?php
  require_once '../includes/conexion.php';

  $idprofesor = $_SESSION['profesor_id'];

  $sql = "SELECT * FROM profesor_materia as pm INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm != 0 AND pm.profesor_id = $idprofesor";
  $query = $pdo->prepare($sql);
  $query->execute();
  $row = $query->rowCount();

  $sqln = "SELECT * FROM profesor_materia as pm INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm != 0 AND pm.profesor_id = $idprofesor";
  $queryn = $pdo->prepare($sqln);
  $queryn->execute();
  $rown = $queryn->rowCount();

  $sqla = "SELECT * FROM profesor_materia as pm INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm != 0 AND pm.profesor_id = $idprofesor";
  $querya = $pdo->prepare($sqla);
  $querya->execute();
  $rowa = $querya->rowCount();
?>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/profesor.png" alt="User Image">
    <div>
      <p class="app-sidebar__user-name"><?= $_SESSION['nombre'];?> </p>
      <p class="app-sidebar__user-designation">Profesor</p>
    </div>
  </div>
  <ul class="app-menu">
  <li><a class="app-menu__item" href="index.php"><i class="fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Inicio</span></a></li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="fa-solid fa-chalkboard-user" style="color: #ffffff;"></i>
        <span class="app-menu__label">Mis Cursos</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <?php if($row > 0) {
          while($data = $query->fetch()){
        ?>
        <li><a class="treeview-item" href="contenido.php?curso=<?= $data['pm_id'] ?>"><i class="fa-solid fa-bookmark" style="color: #ffffff;margin-right: 8px"></i></i><?= $data['nombre_materia']; ?> - <?= $data['nombre_grado']; ?> - <?= $data['nombre_aula']; ?></a></li>
        <?php
          }
        }?>
      </ul>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
      <i class="fa-solid fa-book" style="color: #ffffff;"></i>
        <span class="app-menu__label">Calificaciones</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <?php if($rown > 0) {
          while($datan = $queryn->fetch()){
        ?>
        <li><a class="treeview-item" href="notas.php?curso=<?= $datan['pm_id'] ?>"><i class="fa-solid fa-bookmark" style="color: #ffffff;margin-right: 8px"></i><?= $datan['nombre_materia']; ?> - <?= $datan['nombre_grado']; ?> - <?= $datan['nombre_aula']; ?></a></li>
        <?php
          }
        }?>
      </ul>
    </li>
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
      <i class="fa-solid fa-users"></i>
        <span class="app-menu__label">Alumnos</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <?php if($rowa > 0) {
          while($dataa = $querya->fetch()){
        ?>
        <li><a class="treeview-item" href="alumnos.php?curso=<?= $dataa['pm_id'] ?>"><i class="fa-solid fa-bookmark" style="color: #ffffff;margin-right: 8px"></i><?= $dataa['nombre_materia']; ?> - <?= $dataa['nombre_grado']; ?> - <?= $dataa['nombre_aula']; ?></a></li>
        <?php
          }
        }?>
      </ul>
    </li>
    <li><a class="app-menu__item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Logout</span></a></li>
  </ul>
</aside>