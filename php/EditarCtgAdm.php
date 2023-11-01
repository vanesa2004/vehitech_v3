<?php

    include("conexion_bd.php");

    if (isset($_GET['id_categoria'])) {
        $id_categoria = $_GET['id_categoria'];

        $sql = "SELECT * FROM categorias WHERE id_categoria = $id_categoria";
        $resultado = mysqli_query($conn, $sql);
    
        if ($row = mysqli_fetch_assoc($resultado)) {
            // Aquí obtienes la información de la categoría, por ejemplo:
            $nombre_categoria = $row['nombre'];
    
            // Luego, puedes utilizar $nombre_categoria para prellenar el formulario en el HTML
        } else {
            echo "No se encontró la categoría.";
        }
    
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    }

?>