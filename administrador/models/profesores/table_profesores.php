<<<<<<< HEAD
<?php

require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM profesor WHERE estado != 0';
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0;$i < count($consulta);$i++) {
    if ($consulta[$i]['estado'] == 1) {
        $consulta[$i]['estado'] = '<span class="badge-success">Activo</span>';
    } else {
        $consulta[$i]['estado'] = '<span class="badge-danger">Inactivo</span>';
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary" title="Editar" onclick="editarProfesor('.$consulta[$i]['profesor_id'].')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminarProfesor('.$consulta[$i]['profesor_id'].')">Eliminar</button>
                                ';
}

=======
<?php

require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM profesor WHERE estado != 0';
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0;$i < count($consulta);$i++) {
    if ($consulta[$i]['estado'] == 1) {
        $consulta[$i]['estado'] = '<span class="badge-success">Activo</span>';
    } else {
        $consulta[$i]['estado'] = '<span class="badge-danger">Inactivo</span>';
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary" title="Editar" onclick="editarProfesor('.$consulta[$i]['profesor_id'].')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminarProfesor('.$consulta[$i]['profesor_id'].')">Eliminar</button>
                                ';
}

>>>>>>> 5d4fd43b4726b1ca98184c5e49ea7084f11fcb66
echo json_encode($consulta, JSON_UNESCAPED_UNICODE);    