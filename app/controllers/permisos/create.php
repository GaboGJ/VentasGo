<?php 
include ('../../config.php');

// Iniciar sesión al principio
session_start();

// Verificar si las variables de POST están definidas antes de usarlas
$modulo_id = isset($_POST['modulo_id']) ? $_POST['modulo_id'] : null; // ID del módulo seleccionado
$ver = isset($_POST['ver']) && $_POST['ver'] ? 1 : 0;  // Permiso Ver
$crear = isset($_POST['crear']) && $_POST['crear'] ? 1 : 0;  // Permiso Crear
$editar = isset($_POST['editar']) && $_POST['editar'] ? 1 : 0;  // Permiso Editar
$eliminar = isset($_POST['eliminar']) && $_POST['eliminar'] ? 1 : 0;  // Permiso Eliminar

// Asegúrate de que $modulo_id no esté vacío
if (is_null($modulo_id) || $modulo_id === "") {
    $_SESSION['mensaje'] = "No se seleccionó ningún módulo";
    $_SESSION['icono'] = "warning";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/permisos";
    </script>
    <?php
    exit();
}

// Crear la fecha y hora actual
$fechaHora = date('Y-m-d H:i:s');

// Definir los permisos con las operaciones correspondientes
$permisos = [
    'Ver' => $ver,
    'Crear' => $crear,
    'Editar' => $editar,
    'Eliminar' => $eliminar
];

// Mensaje para permisos ya existentes
$permisos_duplicados = [];

// Insertar los permisos seleccionados
foreach ($permisos as $operacion => $seleccionado) {
    if ($seleccionado) {
        // Verificar si ya existe el permiso
        $sql_verificar = "SELECT COUNT(*) FROM tb_operaciones 
                          WHERE nombre_operacion = :nombre_operacion 
                          AND id_modulo = :id_modulo";
        $stmt_verificar = $pdo->prepare($sql_verificar);
        $stmt_verificar->bindParam(':nombre_operacion', $operacion);
        $stmt_verificar->bindParam(':id_modulo', $modulo_id);
        $stmt_verificar->execute();
        
        // Si ya existe, agregar a la lista de duplicados
        if ($stmt_verificar->fetchColumn() > 0) {
            $permisos_duplicados[] = $operacion; // Agregar a la lista de duplicados
            continue; // Saltar a la siguiente iteración
        }

        // Registrar cada permiso que fue seleccionado (Ver, Crear, Editar, Eliminar)
        $sql_permiso = "INSERT INTO tb_operaciones
                        (nombre_operacion, id_modulo, fyh_creacion) 
                        VALUES (:nombre_operacion, :id_modulo, :fyh_creacion)";
        $stmt_permiso = $pdo->prepare($sql_permiso);
        $stmt_permiso->bindParam(':id_modulo', $modulo_id);
        $stmt_permiso->bindParam(':nombre_operacion', $operacion);
        $stmt_permiso->bindParam(':fyh_creacion', $fechaHora);

        // Ejecutar y verificar errores
        if (!$stmt_permiso->execute()) {
            $_SESSION['mensaje'] = "Error al registrar el permiso: $operacion";
            $_SESSION['icono'] = "error";
            ?>
            <script>
                location.href = "<?php echo $URL; ?>/permisos";
            </script>
            <?php
            exit(); // Detener ejecución en caso de error
        }
    }
}

// Mensaje de éxito si todos los permisos se registraron correctamente
$_SESSION['mensaje'] = "Se registraron los permisos correctamente";

// Si hay permisos duplicados, agrega un mensaje adicional
if (count($permisos_duplicados) > 0) {
    $permisos_duplicados_list = implode(", ", $permisos_duplicados);
    $_SESSION['mensaje'] .= " Los siguientes permisos ya estaban registrados: $permisos_duplicados_list.";
    $_SESSION['icono'] = "warning";
}

?>
<script>
    location.href = "<?php echo $URL; ?>/permisos";
</script>
