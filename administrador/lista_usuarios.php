<<<<<<< HEAD
<<<<<<< HEAD
<?php
    // Incluye el archivo de encabezado (header.php)
    require_once 'includes/header.php';
    // Incluye el archivo que contiene los modales necesarios (modals.php)
    require_once 'includes/modals/modals.php';
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Usuarios</h1>
            <!-- Botón para abrir el modal de nuevo usuario -->
            <button class="btn btn-success" type="button" onclick="openModal()">Nuevo Usuario</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">lista de usuarios</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <!-- Tabla responsive para mostrar la lista de usuarios -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableusuarios">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                        <th>ACCIONES</th>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>USUARIO</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    require_once 'includes/footer.php';
?>
=======
<?php
    require_once 'includes/header.php';
    require_once 'includes/modals/modals.php';
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Usuarios</h1>
            <button class="btn btn-success" type="button" onclick="openModal()">Nuevo Usuario</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">lista de usuarios</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableusuarios">
                    <thead>
                        <tr>
                        <th>ACCIONES</th>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>USUARIO</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    require_once 'includes/footer.php';
?>
>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
=======
<?php
    require_once 'includes/header.php';
    require_once 'includes/modals/modals.php';
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Usuarios</h1>
            <button class="btn btn-success" type="button" onclick="openModal()">Nuevo Usuario</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">lista de usuarios</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableusuarios">
                    <thead>
                        <tr>
                        <th>ACCIONES</th>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>USUARIO</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    require_once 'includes/footer.php';
?>
>>>>>>> ebccd87b7d06dca01d7c509e93888b1f9b88a962
<script type="text/javascript" src="js/functions-usuarios.js"></script>