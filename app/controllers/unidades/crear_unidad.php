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

        // Obtener la fecha y hora actual
        //$fechaHora = date('Y-m-d H:i:s');

        // Asignar parámetros
        $sentencia->bindParam(':nombre_unidad', $nombre_unidad);
        $sentencia->bindParam(':simbolo_unidad', $simbolo_unidad);
        //$sentencia->bindParam(':fyh_creacion', $fechaHora);

        // Ejecutar la sentencia
        $sentencia->execute();

        // Mensaje de éxito
        $_SESSION['mensaje'] = "Unidad creada correctamente.";
        header('Location: ' . $redirect_url); // Redirigir a la URL especificada
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