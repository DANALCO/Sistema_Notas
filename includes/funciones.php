<?php
// Obtiene el directorio base del script actual
$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']); 
// Construye la URL base utilizando el protocolo HTTP, el host actual y el directorio base
$baseUrl = 'http://'. $_SERVER['HTTP_HOST']. $baseDir; 
// Define la constante BASE_URL con la URL base calculada
define('BASE_URL', $baseUrl);

// Función para calcular el promedio de notas de un alumno en un curso
function promedioMateria($alumno, $curso)
{
    /*Al utilizar global $pdo;, la función promedioMateria puede trabajar con la conexión PDO sin importar desde dónde se llame, 
     la variable $pdo es una instancia de la conexión PDO a la base de datos,
     se utiliza para realizar consultas tanto en profesor list-notas como en alumo list-notas */ 
    global $pdo;
    $promedio = 0;

    // Consulta para obtener la cantidad total de evaluaciones de la materia del curso
    /* esta consulta cuenta cuántas evaluaciones están relacionadas con un curso específico al unir las tablas evaluaciones,
     contenidos, y profesor_materia, y luego filtrar por el ID del curso proporcionado. */
    $sqlCanEvaluaciones = "SELECT COUNT(*) as numero FROM evaluaciones AS e INNER JOIN contenidos AS c ON e.contenido_id = c.contenido_id INNER JOIN profesor_materia AS pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = $curso";
    $queryCanEvaluaciones = $pdo->prepare($sqlCanEvaluaciones);
    $queryCanEvaluaciones->execute();

        // Obtiene el número de evaluaciones para el curso dado
    if ($row = $queryCanEvaluaciones->fetch()) {
        $cantEvaluaciones = $row['numero'];
    } else {
        $cantEvaluaciones = 0; // Si no hay evaluaciones para esa materia, el promedio será 0
    }

    // Consulta para obtener todas las notas de la materia del curso, incluyendo las no entregadas
    //esta consulta busca la nota (valor_nota) de un alumno en un curso determinado, La función IFNULL se utiliza para manejar casos en los que no exista una nota para un alumno en particular, devolviendo 0 en ese caso.
    $sqlNotas = "SELECT IFNULL(n.valor_nota, 0) AS valor_nota FROM evaluaciones AS e LEFT JOIN ev_entregadas AS ev ON e.evaluacion_id = ev.evaluacion_id AND ev.alumno_id = $alumno LEFT JOIN notas AS n ON ev.ev_entregada_id = n.ev_entregada_id INNER JOIN contenidos AS c ON e.contenido_id = c.contenido_id INNER JOIN profesor_materia AS pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = $curso";
    $queryNotas = $pdo->prepare($sqlNotas);
    $queryNotas->execute();

    // Calcula el promedio sumando las notas obtenidas en las evaluaciones
    while ($row = $queryNotas->fetch()) {
        $promedio += $row['valor_nota'];
    }

    // Si hay evaluaciones, calcula y devuelve el promedio de notas; de lo contrario, devuelve 0
    if ($cantEvaluaciones > 0) {
        return $promedio / $cantEvaluaciones;
    } else {
        return 0; // Si no hay evaluaciones para esa materia, el promedio será 0
    }
}



//Función para transformar el promedio con searador de mil y 2 decimales
function formato($cantidad){
    //se utiliza para formatear un número con decimales y añadir separadores de miles, decimales y un carácter de separación de miles.
    $cantidad = number_format($cantidad,2,',','.');
    return $cantidad;
}