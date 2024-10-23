<?php
//include ('../../config.php');

// Función para verificar si el usuario tiene un permiso específico
function tiene_permiso($modulo_proporcionado, $operacion_proporcionada, $permisos) {
    foreach ($permisos as $permiso) {
        if (isset($permiso['nombre_modulo']) && isset($permiso['nombre_operacion'])) {
            if ($permiso['nombre_modulo'] === $modulo_proporcionado && $permiso['nombre_operacion'] === $operacion_proporcionada) {
                return true; // Si encuentra coincidencia, devuelve true
            }
        }
    }
    return false; // Si no encuentra coincidencia, devuelve false
}
