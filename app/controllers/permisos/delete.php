<?php
include ('../../config.php');

$id_permiso = $_GET['id_permiso'];

$sentencia = $pdo->prepare("DELETE FROM tb_operaciones WHERE id_operacion=:id_operacion");

$sentencia->bindParam('id_operacion',$id_permiso);

if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se elimino el permiso de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/permisos";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/permisos";
    </script>
    <?php
}
