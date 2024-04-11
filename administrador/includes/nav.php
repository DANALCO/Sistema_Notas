<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/admin-user-icon-4.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name"><?= $_SESSION['nombre'];?> </p>
      <p class="app-sidebar__user-designation"><?= $_SESSION['nombre_rol'];?></p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item" href="lista_usuarios.php"><i class="fa-solid fa-users"></i><span class="app-menu__label">Usuarios</span></a></li>
    <li><a class="app-menu__item" href="lista_profesores.php"><i class="fa-solid fa-chalkboard-user"></i><span class="app-menu__label">Profesores</span></a></li>
    <li><a class="app-menu__item" href="lista_alumnos.php"><i class="fa-solid fa-child"></i><span class="app-menu__label">Alumnos</span></a></li>
    <li><a class="app-menu__item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Logout</span></a></li>
  </ul>
</aside>