<?php
// Incluye el archivo de conexión a la base de datos
require_once '../../../includes/conexion.php';

// Consulta SQL para seleccionar datos de varias tablas utilizando JOINs
$sql = 'SELECT * FROM alumno_profesor as ap INNER JOIN alumnos as a ON ap.alumno_id = a.alumno_id INNER JOIN profesor_materia as pm ON ap.pm_id = pm.pm_id INNER JOIN aulas as au ON pm.aula_id = au.aula_id INNER JOIN materias as m ON pm.materia_id = m.materia_id INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id WHERE ap.estadoap != 0'; // Filtra los registros donde estadoap es distinto de cero
// Prepara y ejecuta la consulta SQL
$query = $pdo->prepare($sql);
$query->execute();
// Obtiene todas las filas de resultados como un array asociativo
$consulta = $query->fetchAll(PDO::FETCH_ASSOC);
// Itera sobre cada fila de resultados para procesar los datos
for ($i = 0; $i < count($consulta); $i++) {
    // Condicional para determinar el estado y asignar un badge HTML correspondiente
    if ($consulta[$i]['estadoap'] == 1) {
        $consulta[$i]['estadoap'] = '<span class="badge-success">Activo</span>';
    } else {
        $consulta[$i]['estadoap'] = '<span class="badge-danger">Inactivo</span>';
    }

    // Agrega botones de acciones a la fila de datos en el array de resultados
    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary" title="Editar" onclick="editarAlumnoProfesor(' . $consulta[$i]['ap_id'] . ')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminarAlumnoProfesor(' . $consulta[$i]['ap_id'] . ')">Eliminar</button>
                                ';
}
// Convierte el array de resultados procesados a formato JSON y lo imprime en la salida
echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
