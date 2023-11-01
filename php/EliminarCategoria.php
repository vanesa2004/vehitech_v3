<?php

    include("conexion_bd.php");

    // Recupera el ID de la categoría desde la URL
    if (isset($_GET['id'])) {
        $categoria_id = $_GET['id'];

        // Consulta SQL para eliminar la categoría
        $sql = "DELETE FROM categorias WHERE id_categoria = $categoria_id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Categoría eliminada con éxito.";
        } else {
            echo "Error al eliminar la categoría: " . $conn->error;
        }
    } else {
        echo "ID de categoría no especificado.";
    }

    // Cierra la conexión a la base de datos
    $conn->close();

?>