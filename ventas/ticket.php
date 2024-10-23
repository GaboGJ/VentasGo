<?php
header('Content-Type: text/html; charset=UTF-8');
include('../app/config.php');
include('../app/controllers/ventas/literal.php');

// Obtener parámetros desde la URL
$nro_venta_get = $_GET['nro_venta'];
$id_cliente_get = $_GET['id_cliente'];

// Consulta para obtener los datos de la venta y del cliente
$sql_ventas = "SELECT *, cli.nombre_cliente as nombre_cliente, cli.nit_ci_cliente as nit_ci_cliente 
               FROM tb_ventas as ve 
               INNER JOIN tb_clientes as cli ON cli.id_cliente = ve.id_cliente 
               WHERE ve.nro_venta = '$nro_venta_get'";
$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetch(PDO::FETCH_ASSOC);

// Verificar si se obtuvieron los datos
if ($ventas_datos) {
    $fyh_creacion = $ventas_datos['fyh_creacion'];
    $nit_ci_cliente = $ventas_datos['nit_ci_cliente'];
    $nombre_cliente = $ventas_datos['nombre_cliente'];
    $total_pagado = $ventas_datos['total_pagado'];
}

// Convertir el monto total a literal
$monto_literal = numtoletras($total_pagado);

// Formatear la fecha de la venta
$fecha = date("d/m/Y", strtotime($fyh_creacion));

// Crear el HTML completo para el ticket
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Venta</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
    <div id="ticket">
        <b>FAZENDA</b><br>
        Boutique de Carnes<br>
        Tel: 78293386<br>
        NIT: <br>
        ----------------------------<br>
        <b>TICKET DE VENTA</b><br>
        Fecha: <?php echo $fecha; ?><br>
        Nro. Venta: <?php echo $nro_venta_get; ?><br>
        Cliente: <?php echo $nombre_cliente; ?><br>
        NIT/CI: <?php echo $nit_ci_cliente; ?><br>
        ----------------------------<br>
    </div>

    <table>
        <tr>
            <th style="width: 60%;">Producto</th>
            <th style="width: 20%;">Cant.</th>
            <th style="width: 20%;">Total</th>
        </tr>
        <?php
        // Consultar los productos de la venta
        $sql_productos = "SELECT *, pro.nombre as nombre_producto, pro.descripcion as descripcion, 
                             pro.precio_venta as precio_unitario, pro.stock as stock, 
                             carr.cantidad as cantidad, 
                             (carr.cantidad * pro.precio_venta) as precio_total 
                          FROM tb_carrito AS carr 
                          INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto 
                          WHERE nro_venta = '$nro_venta_get' 
                          ORDER BY carr.id_carrito ASC";
        $query_productos = $pdo->prepare($sql_productos);
        $query_productos->execute();
        $productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);

        // Agregar cada producto a la tabla
        foreach ($productos_datos as $producto) {
            echo '<tr>
                <td>' . htmlspecialchars($producto['nombre_producto']) . '</td>
                <td>' . htmlspecialchars($producto['cantidad']) . '</td>
                <td>' . number_format($producto['precio_total'], 2) . '</td>
            </tr>';
        }
        ?>
    </table>

    <div style="text-align: right;">
        <b>Total:</b> Bs. <?php echo number_format($total_pagado, 2); ?><br>
        <b>Monto Literal:</b> <?php echo $monto_literal; ?><br>
        
    </div>

    <div style="text-align: center;">
    ----------------------------<br>
        Gracias por su compra<br>
        FAZENDA<br>
        ----------------------------<br>
        "Este es un documento válido, conserve su ticket"
    </div>

</body>
</html>
