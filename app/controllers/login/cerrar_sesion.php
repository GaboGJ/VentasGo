<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 18/1/2023
 * Time: 08:47
 */

include ('../../config.php');

session_start();
if(isset($_SESSION['sesion_email']) && isset($_SESSION['permisos'])){
    session_destroy();
    header('Location: '.$URL.'/');
}