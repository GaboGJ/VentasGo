<?php
/* Creado por Gabriel Guayhua Janco 03/10/2024 */

// Obtener permisos asignados al rol
$id_rol = isset($_GET['id']) ? $_GET['id'] : null; // ID del rol desde la URL
if ($id_rol === null) {
    echo "No se proporcionó un ID de rol válido.";
    //exit;
}
$sql_permisos_asignados = "SELECT id_operacion 
                           FROM tb_permisos
                           WHERE id_rol = :id_rol";

$query_permisos_asignados = $pdo->prepare($sql_permisos_asignados);
$query_permisos_asignados->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
$query_permisos_asignados->execute();
$permisos_asignados = $query_permisos_asignados->fetchAll(PDO::FETCH_COLUMN); // Obtener solo los IDs


