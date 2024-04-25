<?php

require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM alumno_profesor as ap INNER JOIN alumnos as a ON ap.alumno_id = a.alumno_id INNER JOIN profesor_materia as pm ON ap.pm_id = pm.pm_id INNER JOIN aulas as au ON pm.aula_id = au.aula_id INNER JOIN materias as m ON pm.materia_id = m.materia_id INNER JOIN periodos as pe ON ap.periodo_id = pe.periodo_id INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id WHERE ap.estadoap != 0';
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0;$i < count($consulta);$i++) {
    if ($consulta[$i]['estadoap'] == 1) {
        $consulta[$i]['estadoap'] = '<span class="badge-success">Activo</span>';
    } else {
        $consulta[$i]['estadoap'] = '<span class="badge-danger">Inactivo</span>';
    }

    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary" title="Editar" onclick="editarAlumnoProfesor('.$consulta[$i]['ap_id'].')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminarAlumnoProfesor('.$consulta[$i]['ap_id'].')">Eliminar</button>
                                ';
}

echo json_encode($consulta, JSON_UNESCAPED_UNICODE);    