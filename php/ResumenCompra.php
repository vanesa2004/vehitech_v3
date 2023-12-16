<?php

    session_start();
    include("conexion_bd.php");

    // Consulta para obtener el resumen de compra desde la base de datos
    $sqlResumenCompra = "SELECT articulos.nombre AS nombre_articulo, carrito.cantidad, carrito.total
                        FROM carrito
                        INNER JOIN articulos ON carrito.id_articulo = articulos.id_articulo";

    $result = $conn->query($sqlResumenCompra);

    if ($result) {
        $resumenCompra = array();
        while ($row = $result->fetch_assoc()) {
            // Formatear los valores numéricos con separadores de miles
            $row['cantidad'] = number_format($row['cantidad'], 0, ',', '.'); // Formato sin decimales
            $row['total'] = number_format($row['total'], 0, ',', '.'); // Formato sin decimales
            $resumenCompra[] = $row;
        }
        echo json_encode($resumenCompra);
    } else {
        echo json_encode(array("error" => "Error al obtener el resumen de compra"));
    }
    
?>