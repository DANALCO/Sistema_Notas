<?php
// Incluye el archivo de encabezado (header.php)
    require_once 'includes/header.php';
    // Incluye el archivo que contiene el modal para agregar un nuevo proceso de alumno-profesor (modal_alumno_profesor.php)
    require_once 'includes/modals/modal_alumno_profesor.php';
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Lista de Proceso alumnos</h1>
            <!-- Botón para abrir el modal de nuevo proceso de alumno-profesor -->
            <button class="btn btn-success" type="button" onclick="openModalAlumnoProfesor()">Nuevo Proceso Alumno</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">lista de proceso alumnos</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <!-- Tabla responsive para mostrar la lista de procesos alumno-profesor -->
                <div class="table-responsive">
                    <!-- Tabla con estilo de Bootstrap -->
                    <table class="table table-hover table-bordered" id="tablealumnoprofesor">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                        <th>ACCIONES</th>
                        <th>ID</th>
                        <th>NOMBRE DEL ALUMNO</th>
                        <th>NOMBRE DEL PROFESOR</th>
                        <th>GRADO</th>
                        <th>MATERIA</th>
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
<script type="text/javascript" src="js/functions-alumno-profesor.js"></script>