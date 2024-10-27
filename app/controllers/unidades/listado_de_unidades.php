<?php

try {
    // Consulta para obtener todas las unidades de medida
    $query = "SELECT * FROM tb_unidades";
    $sentencia = $pdo->prepare($query);
    $sentencia->execute();
    
    // Obtener todos los resultados
    $unidades_datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Manejo de errores
    echo "Error: " . $e->getMessage();
}
?>