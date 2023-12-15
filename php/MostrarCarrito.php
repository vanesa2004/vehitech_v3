<?php

    session_start();
    include("conexion_bd.php");

    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
        $idUsuario = $_SESSION['usuario_id'];

        // Obtener los productos en el carrito del usuario actual con su información
        $queryCarrito = "SELECT carrito.cantidad, articulos.nombre AS nombre_articulo, articulos.precio, articulos.imagen
                        FROM carrito 
                        INNER JOIN articulos ON carrito.id_articulo = articulos.id_articulo 
                        WHERE carrito.id_usuario = '$idUsuario'";

        $resultCarrito = $conn->query($queryCarrito);

        if ($resultCarrito->num_rows > 0) {
            $productos_carrito = array();

            while ($row = $resultCarrito->fetch_assoc()) {
                $productos_carrito[] = $row;
            }

            // Devolver los productos en formato JSON
            echo json_encode($productos_carrito);
        } else {
            echo json_encode(array('error' => 'No tienes artículos agregados en el carrito'));
        }
    } else {
        echo json_encode(array('error' => 'Usuario no autenticado'));
    }

    

    $conn->close();
    
?>