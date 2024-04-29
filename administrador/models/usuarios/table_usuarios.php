<?php
// Requiere el archivo de conexión
require_once '../../../includes/conexion.php';
// Prepara la consulta para obtener usuarios activos con sus roles
$sql = 'SELECT * FROM usuarios as u INNER JOIN rol as r ON u.rol = r.rol_id WHERE u.estado != 0';
$query = $pdo->prepare($sql);
$query->execute();

// Obtiene los resultados como un arreglo asociativo
$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

// Itera sobre los resultados para procesarlos antes de codificarlos como JSON
for ($i = 0; $i < count($consulta); $i++) {
    // Reemplaza el estado numérico con una etiqueta de badge según su valor
    if ($consulta[$i]['estado'] == 1) {
        $consulta[$i]['estado'] = '<span class="badge-success">Activo</span>';
    } else {
        $consulta[$i]['estado'] = '<span class="badge-danger">Inactivo</span>';
    }
    // Agrega botones de editar y eliminar a cada elemento en el resultado
    $consulta[$i]['acciones'] = '
        <button class="btn btn-primary" title="Editar" onclick="editarUsuario(' . $consulta[$i]['usuario_id'] . ')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminarUsuario(' . $consulta[$i]['usuario_id'] . ')">Eliminar</button>
                                ';
}
// Codifica el resultado final como JSON y lo imprime
echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
