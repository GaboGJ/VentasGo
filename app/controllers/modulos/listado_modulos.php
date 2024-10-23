<?php
$sql_modulos = "SELECT * FROM tb_modulos";

$query_modulos = $pdo->prepare($sql_modulos);
$query_modulos->execute();
$modulos_datos = $query_modulos->fetchAll(PDO::FETCH_ASSOC);
