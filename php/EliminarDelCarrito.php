<?php

    session_start();
    include("conexion_bd.php");

    // Verificar si se recibió el ID del artículo a eliminar
    if (isset($_POST['id_articulo'])) {
        $idArticulo = $_POST['id_articulo'];

        // Realizar la eliminación del artículo del carrito en la base de datos
        $stmt = $conn->prepare("DELETE FROM carrito WHERE id_articulo = ?");
        $stmt->bind_param("i", $idArticulo);

        if ($stmt->execute()) {
            // Éxito al eliminar el artículo del carrito
            echo json_encode(array("success" => true));
        } else {
            // Error al eliminar el artículo del carrito
            echo json_encode(array("success" => false, "error" => "Error al eliminar el artículo del carrito: " . $conn->error));
        }
    } else {
        // Si no se recibió el ID del artículo
        echo json_encode(array("success" => false, "error" => "ID de artículo no recibido"));
    }
    
?>