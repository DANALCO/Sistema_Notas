<?php

require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM profesor_materia as pm INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm != 0';
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0;$i < count($consulta);$i++) {
    if ($consulta[$i]['estadopm'] == 1) {
        $consulta[$i]['estadopm'] = '<span class="badge-success">Activo</span>';
    } else {
        $consulta[$i]['estadopm'] = '<span class="badge-danger">Inactivo</span>';
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary" title="Editar" onclick="editarProfesorMateria('.$consulta[$i]['pm_id'].')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminarProfesorMateria('.$consulta[$i]['pm_id'].')">Eliminar</button>
                                ';
}

echo json_encode($consulta, JSON_UNESCAPED_UNICODE);    