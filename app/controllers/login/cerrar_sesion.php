<?php
 include ('../../config.php');
 
 if (!file_exists('../../config.php')) {
     die('Error: Config file not found.');
 }
 
 session_start();
 
 // Verifica si al menos una de las variables de sesión está activa
 if (isset($_SESSION['sesion_email']) || isset($_SESSION['permisos'])) {
     // Limpia las variables de sesión y destruye la sesión
     session_unset();
     session_destroy();
 }
 
 // Redirige al usuario
 header('Location: ' . $URL . '/');
 exit();
?>