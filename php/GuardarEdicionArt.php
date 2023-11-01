<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener el ID del artículo a editar desde la URL si está presente
        if (isset($_GET['codigo'])) {
            $codigo_articulo = $_GET['codigo'];

            // Conectar a la base de datos
            include("conexion_bd.php");

            // Preparar la consulta SQL para obtener la información actual del artículo
            $sql = "SELECT * FROM articulos WHERE id_articulo = $codigo_articulo";
            $resultado = mysqli_query($conn, $sql);

            if ($row = mysqli_fetch_assoc($resultado)) {
                $nombre_actual = $row['nombre'];
                $descripcion_actual = $row['descripcion'];
                
                $categoria_actual = $row['id_categoria'];
                $precio_actual = $row['precio'];
                $cantidad_actual = $row['cantidad'];

                // Obtener los valores enviados desde el formulario
                $nombre_nuevo = $_POST['nombre'];
                $descripcion_nueva = $_POST['descripcion'];
                $nombre_imagen = $_FILES['nueva_imagen']['name'];
                $categoria_nueva = $_POST['categoria'];
                $precio_nuevo = $_POST['precio'];
                $cantidad_nueva = $_POST['cantidad'];


                // Ruta donde se guardará la nueva imagen en el servidor
                $ruta_nueva_imagen = "../img/ArticulosCompraventa/" . $nombre_imagen;

                // Mover la nueva imagen al directorio de destino
                if (move_uploaded_file($_FILES['nueva_imagen']['tmp_name'], $ruta_nueva_imagen)) {
                    // Actualizar la ruta de la imagen en la base de datos
                    $sql_actualizar_imagen = "UPDATE articulos SET imagen = '$ruta_nueva_imagen' WHERE id_articulo = $codigo_articulo";
                    
                    if (mysqli_query($conn, $sql_actualizar_imagen)) {
                        // Éxito, la imagen se ha actualizado correctamente en la base de datos
                        echo "Imagen actualizada exitosamente.";
                    } else {
                        echo "Error al actualizar la ruta de la imagen en la base de datos: " . mysqli_error($conn);
                    }
                } 

                // Verificar si los valores enviados son diferentes de los actuales y actualizar solo los campos editados
                if ($nombre_nuevo !== $nombre_actual) {
                    $sql_actualizar_nombre = "UPDATE articulos SET nombre = '$nombre_nuevo' WHERE id_articulo = $codigo_articulo";
                    mysqli_query($conn, $sql_actualizar_nombre);
                }

                if ($descripcion_nueva !== $descripcion_actual) {
                    $sql_actualizar_descripcion = "UPDATE articulos SET descripcion = '$descripcion_nueva' WHERE id_articulo = $codigo_articulo";
                    mysqli_query($conn, $sql_actualizar_descripcion);
                }

                if ($categoria_nueva !== $categoria_actual) {
                    $sql_actualizar_categoria = "UPDATE articulos SET id_categoria = '$categoria_nueva' WHERE id_articulo = $codigo_articulo";
                    mysqli_query($conn, $sql_actualizar_categoria);
                }

                if ($precio_nuevo !== $precio_actual) {
                    $sql_actualizar_precio = "UPDATE articulos SET precio = '$precio_nuevo' WHERE id_articulo = $codigo_articulo";
                    mysqli_query($conn, $sql_actualizar_precio);
                }

                if ($cantidad_nueva !== $cantidad_actual) {
                    $sql_actualizar_cantidad = "UPDATE articulos SET cantidad = '$cantidad_nueva' WHERE id_articulo = $codigo_articulo";
                    mysqli_query($conn, $sql_actualizar_cantidad);
                }
                
                echo "Edición exitosa.";
                } else {
                    echo "No se encontró el artículo.";
                }

            // Cerrar la conexión a la base de datos
            mysqli_close($conn);
        }
    }

?>