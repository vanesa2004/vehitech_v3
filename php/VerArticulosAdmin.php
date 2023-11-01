<?php

    // Conectar a la base de datos 
    include("conexion_bd.php");

    // Preparar la consulta SQL para obtener los artículos de la tabla "articulos"
    $sql = "SELECT * FROM articulos";

    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $sql);

    // Verificar si se encontraron registros
    if (mysqli_num_rows($resultado) > 0) {
        // Generar las filas de la tabla con los datos de cada artículo
        while ($row = mysqli_fetch_assoc($resultado)) {
            $codigo = $row['id_articulo'];
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $foto = $row['imagen'];
            $precio = $row['precio'];
            $cantidad = $row['cantidad'];
            $categoria_id = $row['id_categoria']; // Obtener el ID de la categoría

            // Consulta para obtener el nombre de la categoría
            $sql_categoria = "SELECT categoria FROM categorias WHERE id_categoria = $categoria_id";
            $resultado_categoria = mysqli_query($conn, $sql_categoria);

            if ($row_categoria = mysqli_fetch_assoc($resultado_categoria)) {
                $categoria = $row_categoria['categoria'];
            } else {
                $categoria = "Categoría no encontrada";
            }

            echo "<article>";
            echo "<td><img src='$foto' alt='Foto'></td>";
            echo "<h3>$nombre</h3>";
            echo "<p><b>Descripción: </b>$descripcion</p>";
            echo "<p><b>Cantidad: </b>$cantidad</p>";
            echo "<p><b>Categoría: </b>$categoria</p>";
            echo "<p><b>Precio: </b>$precio</p>";
            echo "<div class='btns'>";
            echo "<a href='../pages/AdminEditarArticulo.php?codigo=" . $codigo . "'>Editar</a>";
            echo " <button>Eliminar</button>";
            echo "</div>";

            echo "</article>";
        }
    } else {
        echo "No se encontraron artículos.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
?>