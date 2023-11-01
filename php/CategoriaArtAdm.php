<?php

    // Obtén el ID del artículo a editar desde la URL
    if (isset($_GET['codigo'])) {
        $codigo_articulo = $_GET['codigo'];

        // Conectar a la base de datos
        include("conexion_bd.php");

        // Preparar la consulta SQL para obtener la información del artículo
        $sql = "SELECT * FROM articulos WHERE id_articulo = $codigo_articulo";
        $resultado = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($resultado)) {
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $foto = $row['imagen'];
            $precio = $row['precio'];
            $cantidad = $row['cantidad'];
            $categoria_id = $row['id_categoria'];
        } else {
            echo "No se encontró el artículo.";
        }

        // Consulta para obtener todas las categorías disponibles
        $sql_categorias = "SELECT id_categoria, categoria FROM categorias";
        $resultado_categorias = mysqli_query($conn, $sql_categorias);

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    }


?>