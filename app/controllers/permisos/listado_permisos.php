<?php

/*Creado por Gabriel Guayhua Janco 03/10/2024 */
$sql_modulos_operaciones = "SELECT *
                            FROM tb_modulos m 
                            INNER JOIN tb_operaciones o 
                            ON m.id_modulo = o.id_modulo";

$query_modulos_operaciones = $pdo->prepare($sql_modulos_operaciones);
$query_modulos_operaciones->execute();
$modulos_operaciones_datos = $query_modulos_operaciones->fetchAll(PDO::FETCH_ASSOC);
