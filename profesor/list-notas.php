<?php
if(!empty($_GET['curso']) || !empty($_GET['alumno'])){
    $curso = $_GET['curso'];
    $alumno = $_GET['alumno'];
}else{
    header("Location: ./");
}
    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    require_once '../includes/funciones.php';

    $idprofesor = intval($_SESSION['profesor_id']);

    $sql = "SELECT ev.titulo, IFNULL(n.valor_nota, 0) AS valor_nota FROM evaluaciones AS ev LEFT JOIN ev_entregadas AS ev_e ON ev.evaluacion_id = ev_e.evaluacion_id AND ev_e.alumno_id = :alumno LEFT JOIN notas AS n ON ev_e.ev_entregada_id = n.ev_entregada_id INNER JOIN contenidos AS c ON ev.contenido_id = c.contenido_id INNER JOIN profesor_materia AS pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = :curso";

    $query = $pdo->prepare($sql);
    $query->bindValue(':alumno', $alumno, PDO::PARAM_INT);
    $query->bindValue(':curso', $curso, PDO::PARAM_INT);
    $query->execute();
    
    $row = $query->rowCount();
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Notas Cargadas</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Notas Cargadas</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="title-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>EVALUACION</th>
                                    <th>NOTA</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($row > 0) {
                                while($data = $query->fetch()) {
                                ?>
                                <tr>
                                    <td><?= $data['titulo'] ?></td>
                                    <td><?= $data['valor_nota'] ?></td>
                                </tr>
                            <?php 
                                }}
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="bs-component">
                <ul class="list-group">
                    <li class="list-group-item"><span class="tag tag-default tag-pill float-xs-right"><strong>PROMEDIO: <?= formato(promedio($alumno,$curso)); ?></strong></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <a href="notas.php?curso=<?= $curso?>" class="btn btn-info"><< Volver Atras</a>
    </div>
</main>
<?php
    require_once 'includes/footer.php';
?>