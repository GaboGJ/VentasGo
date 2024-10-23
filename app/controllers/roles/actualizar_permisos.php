<?php
include ('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';
    $id_rol = isset($_POST['id_rol']) ? $_POST['id_rol'] : null;
    $id_operacion = isset($_POST['id_operacion']) ? $_POST['id_operacion'] : null;

    if ($id_rol && $id_operacion) {
        if ($accion == 'agregar') {
            // Insertar nuevo permiso
            $sql_insert = "INSERT INTO tb_permisos (id_rol, id_operacion) VALUES (:id_rol, :id_operacion)";
            $query_insert = $pdo->prepare($sql_insert);
            $query_insert->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $query_insert->bindParam(':id_operacion', $id_operacion, PDO::PARAM_INT);
            if ($query_insert->execute()) {
                echo "Permiso añadido correctamente.";
            } else {
                echo "Error al añadir el permiso.";
            }
        } elseif ($accion == 'eliminar') {
            // Eliminar permiso
            $sql_delete = "DELETE FROM tb_permisos WHERE id_rol = :id_rol AND id_operacion = :id_operacion";
            $query_delete = $pdo->prepare($sql_delete);
            $query_delete->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $query_delete->bindParam(':id_operacion', $id_operacion, PDO::PARAM_INT);
            if ($query_delete->execute()) {
                echo "Permiso eliminado correctamente.";
            } else {
                echo "Error al eliminar el permiso.";
            }
        }
    } else {
        echo "Datos inválidos.";
    }
} else {
    echo "Método no permitido.";
}
