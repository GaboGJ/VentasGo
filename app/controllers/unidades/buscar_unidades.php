<?php
include ('../../config.php');

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $sentencia = $pdo->prepare("SELECT id_unidad, nombre_unidad, simbolo_unidad FROM tb_unidades WHERE nombre_unidad LIKE ?");
    $sentencia->execute(["%$query%"]);
    $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultados as $unidad) {
        echo '<div class="unidad-item" data-id="'.$unidad['id_unidad'].'">'.$unidad['nombre_unidad'].' ('.$unidad['simbolo_unidad'].')</div>';
    }
}
?>