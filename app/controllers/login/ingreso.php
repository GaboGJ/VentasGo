<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 17/1/2023
 * Time: 16:19
 */
// Iniciar sesión
session_start();
include('../../config.php');

$email = $_POST['email'];
$password_user = $_POST['password_user'];


// Asegúrate de que la sesión se inicie antes de guardar datos en $_SESSION
$sql = "SELECT 
            m.nombre_modulo, 
            o.nombre_operacion 
        FROM 
            tb_usuarios u 
        INNER JOIN 
            tb_roles r ON u.id_rol = r.id_rol 
        INNER JOIN 
            tb_permisos p ON r.id_rol = p.id_rol 
        INNER JOIN 
            tb_operaciones o ON p.id_operacion = o.id_operacion 
        INNER JOIN 
            tb_modulos m ON o.id_modulo = m.id_modulo 
        WHERE 
            u.email = '$email'";

$query = $pdo->prepare($sql);
$query->execute();

if ($query->rowCount() > 0) {
    $permisos = $query->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['permisos'] = $permisos; // Guardar permisos en sesión
} else {
    echo "No se encontraron permisos para el usuario.";
}

$contador = 0;
$sql = "SELECT * FROM tb_usuarios WHERE email = '$email' ";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as $usuario){
    $contador = $contador + 1;
    $email_tabla = $usuario['email'];
    $nombres = $usuario['nombres'];
    $password_user_tabla = $usuario['password_user'];
}



if( ($contador > 0) && (password_verify($password_user, $password_user_tabla))  ){
    echo "Datos correctos";
    session_start();
    $_SESSION['sesion_email'] = $email;
    header('Location: '.$URL.'/index.php');
}else{
    echo "Datos incorrectos, vuelva a intentarlo";
    session_start();
    $_SESSION['mensaje'] = "Error datos incorrectos";
    header('Location: '.$URL.'/login');
}

