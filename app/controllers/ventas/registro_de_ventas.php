<?php

include ('../../config.php');


$nro_venta = $_GET['nro_venta'];
$id_cliente = $_GET['id_cliente'];
$total_a_cancelar = $_GET['total_a_cancelar'];


$pdo->beginTransaction();

$sentencia = $pdo->prepare("INSERT INTO tb_ventas
       ( nro_venta, id_cliente, total_pagado, fyh_creacion) 
VALUES (:nro_venta,:id_cliente,:total_pagado,:fyh_creacion)");

$sentencia->bindParam('nro_venta',$nro_venta);
$sentencia->bindParam('id_cliente',$id_cliente);
$sentencia->bindParam('total_pagado',$total_a_cancelar);

$sentencia->bindParam('fyh_creacion',$fechaHora);

if($sentencia->execute()) {
    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "Se registró la venta de manera correcta";
    $_SESSION['icono'] = "success";

   
} else {
    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Error, no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/ventas/create.php";
    </script>
    <?php
}







