<!-- Barra lateral del menú -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <!-- Perfil del usuario -->
  <div class="app-sidebar__user">
    <img class="app-sidebar__user-avatar" src="images/admin-user-icon-4.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name"><?= $_SESSION['nombre'];?> </p>
      <p class="app-sidebar__user-designation"><?= $_SESSION['nombre_rol'];?></p>
    </div>
  </div>
  <!-- Menú de la aplicación -->
  <ul class="app-menu">
    <!-- Elementos del menú -->
    <li><a class="app-menu__item" href="index.php"><i class="fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Inicio</span></a></li>
    <li><a class="app-menu__item" href="lista_usuarios.php"><i class="fa-solid fa-users"></i><span class="app-menu__label">Usuarios</span></a></li>
    <li><a class="app-menu__item" href="lista_profesores.php"><i class="fa-solid fa-chalkboard-user"></i><span class="app-menu__label">Profesores</span></a></li>
    <li><a class="app-menu__item" href="lista_alumnos.php"><i class="fa-solid fa-child"></i><span class="app-menu__label">Alumnos</span></a></li>
    <li><a class="app-menu__item" href="lista_grados.php"><i class="fa-solid fa-medal" style="color: #ffffff;"></i><span class="app-menu__label">Grados</span></a></li>
    <li><a class="app-menu__item" href="lista_aulas.php"><i class="fa-solid fa-city" style="color: #ffffff;"></i><span class="app-menu__label">Aulas</span></a></li>
    <li><a class="app-menu__item" href="lista_materias.php"><i class="fa-solid fa-book-bookmark" style="color: #ffffff;"></i><span class="app-menu__label">Materias</span></a></li>
    <li><a class="app-menu__item" href="lista_profesor_materia.php"><i class="fa-solid fa-chalkboard-user" style="color: #ffffff;"></i><span class="app-menu__label">Profesor Materia</span></a></li>
    <li><a class="app-menu__item" href="lista_alumno_profesor.php"><i class="fa-solid fa-user-plus" style="color: #ffffff;"></i><span class="app-menu__label">Alumno Profesor</span></a></li>
    <li><a class="app-menu__item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Logout</span></a></li>
  </ul>
</aside>
