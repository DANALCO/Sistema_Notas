<?php
$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']); 
$baseUrl = 'http://'. $_SERVER['HTTP_HOST']. $baseDir; 
define('BASE_URL', $baseUrl);

function promedio($alumno, $curso)
{
    global $pdo;
    $promedio = 0;

    // Consulta para obtener la cantidad total de evaluaciones de la materia del curso
    $sqlCanEvaluaciones = "SELECT COUNT(*) as numero FROM evaluaciones AS e INNER JOIN contenidos AS c ON e.contenido_id = c.contenido_id INNER JOIN profesor_materia AS pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = $curso";
    $queryCanEvaluaciones = $pdo->prepare($sqlCanEvaluaciones);
    $queryCanEvaluaciones->execute();

    if ($row = $queryCanEvaluaciones->fetch()) {
        $cantEvaluaciones = $row['numero'];
    } else {
        $cantEvaluaciones = 0; // Si no hay evaluaciones para esa materia, el promedio será 0
    }

    // Consulta para obtener todas las notas de la materia del curso, incluyendo las no entregadas
    $sqlNotas = "SELECT IFNULL(n.valor_nota, 0) AS valor_nota FROM evaluaciones AS e LEFT JOIN ev_entregadas AS ev ON e.evaluacion_id = ev.evaluacion_id AND ev.alumno_id = $alumno LEFT JOIN notas AS n ON ev.ev_entregada_id = n.ev_entregada_id INNER JOIN contenidos AS c ON e.contenido_id = c.contenido_id INNER JOIN profesor_materia AS pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = $curso";
    $queryNotas = $pdo->prepare($sqlNotas);
    $queryNotas->execute();

    $count = $queryNotas->rowCount();

    while ($row = $queryNotas->fetch()) {
        $promedio += $row['valor_nota'];
    }

    if ($cantEvaluaciones > 0) {
        return $promedio / $cantEvaluaciones;
    } else {
        return 0; // Si no hay evaluaciones para esa materia, el promedio será 0
    }
}



function formato($cantidad){
    $cantidad = number_format($cantidad,2,',','.');
    return $cantidad;
}