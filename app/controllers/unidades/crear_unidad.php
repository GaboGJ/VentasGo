<?php
include ('../../config.php');

// Iniciar la sesión
session_start();

// Obtener datos del formulario
$nombre_unidad = $_POST['nombre_unidad'] ?? '';
$simbolo_unidad = $_POST['simbolo_unidad'] ?? '';

// Obtener la URL de redirección desde el formulario
$redirect_url = $_POST['redirect_url'] ?? $URL . '/unidades/'; // Valor por defecto

// Validar que los campos no estén vacíos
if (!empty($nombre_unidad) && !empty($simbolo_unidad)) {
    try {
        // Preparar la sentencia SQL
        $sentencia = $pdo->prepare("INSERT INTO tb_unidades (nombre_unidad, simbolo_unidad) 
            VALUES (:nombre_unidad, :simbolo_unidad)");

        // Asignar parámetros
        $sentencia->bindParam(':nombre_unidad', $nombre_unidad);
        $sentencia->bindParam(':simbolo_unidad', $simbolo_unidad);

        // Ejecutar la sentencia
        $sentencia->execute();

        // Obtener el ID de la unidad recién creada
        $idUnidadGuardada = $pdo->lastInsertId();

        // Mensaje de éxito
        $_SESSION['mensaje'] = "Unidad creada correctamente.";
        
        // Redirigir a la URL especificada con el ID de la unidad como parámetro
        header('Location: ' . $redirect_url . '?selected_id=' . $idUnidadGuardada);
        exit();
    } catch (PDOException $e) {
        // Manejar errores de base de datos
        $_SESSION['mensaje'] = "Error al crear la unidad: " . $e->getMessage();
        header('Location: ' . $redirect_url); // Redirigir a la URL especificada
        exit();
    }
} else {
    // Manejar campos vacíos
    $_SESSION['mensaje'] = "Error: todos los campos son obligatorios.";
    header('Location: ' . $redirect_url); // Redirigir a la URL especificada
    exit();
}
?>