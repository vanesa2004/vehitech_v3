<?php

    session_start();
    include("conexion_bd.php");

    // Verificar si se reciben los datos esperados para actualizar la cantidad
    if (isset($_POST['id_articulo']) && isset($_POST['cantidad'])) {
        $idArticulo = $_POST['id_articulo'];
        $nuevaCantidad = $_POST['cantidad'];

        // Actualizar la cantidad del producto en la tabla carrito
        $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id_articulo = ?");
        $stmt->bind_param("ii", $nuevaCantidad, $idArticulo);

        if ($stmt->execute()) {
            // Si la actualización de la cantidad es exitosa, se procede a calcular y actualizar el total del carrito
            calcularYActualizarTotal($conn);
        } else {
            echo json_encode(array("success" => false, "error" => "Error al actualizar la cantidad: " . $conn->error));
        }
    } else {
        echo json_encode(array("success" => false, "error" => "Datos incompletos"));
    }

    function calcularYActualizarTotal($conn) {
        // Actualizar el campo 'total' en la tabla 'carrito' basado en el cálculo de precio por cantidad
        $sqlUpdateTotal = "UPDATE carrito AS c
                        INNER JOIN articulos AS a ON c.id_articulo = a.id_articulo
                        SET c.total = a.precio * c.cantidad";

        if ($conn->query($sqlUpdateTotal) === TRUE) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "error" => "Error al calcular y actualizar el total del carrito: " . $conn->error));
        }
    }

?>