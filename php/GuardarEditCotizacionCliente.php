<?php

    include("conexion_bd.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $idCotizacion = $_POST["id_cotizacion"];
        $nombreArticulo = $_POST["nameart"];
        $descripcion = $_POST["descripcion"];
        $accion = $_POST["accion"];
        $visibleAdmin= 1;
    
        // Verifica si se cargó una nueva imagen
        if (!empty($_FILES["nueva_imagen"]["name"])) {
            // Ruta donde se almacenarán las imágenes (ajusta según tu configuración)
            $rutaImagenes = "../img/cotizaciones/";
            
            // Genera un nombre de archivo único para la nueva imagen
            $nombreArchivo = uniqid() . "_" . $_FILES["nueva_imagen"]["name"];
            
            // Ruta completa de la nueva imagen
            $rutaCompletaNuevaImagen = $rutaImagenes . $nombreArchivo;
            
            // Mueve la nueva imagen al servidor
            if (move_uploaded_file($_FILES["nueva_imagen"]["tmp_name"], $rutaCompletaNuevaImagen)) {
                // Consulta SQL para actualizar los detalles de la cotización con la nueva imagen
                $sql = "UPDATE cotizacion SET nombre_articulo = '$nombreArticulo', descripcion = '$descripcion', accion = '$accion', foto = '$nombreArchivo' WHERE id_cotizacion = '$idCotizacion'";
            } else {
                echo "Error al cargar la nueva imagen.";
            }
        } else {
            // Si no se cargó una nueva imagen, actualiza los detalles sin modificar la imagen actual
            $sql = "UPDATE cotizacion SET nombre_articulo = '$nombreArticulo', descripcion = '$descripcion', accion = '$accion', visible_admin ='$visibleAdmin' WHERE id_cotizacion = '$idCotizacion'";
        }
        
        // Ejecuta la consulta SQL
        if ($conn->query($sql) === TRUE) {
            // Redirige de vuelta a la página de visualización de cotizaciones o muestra un mensaje de éxito
            header("Location: ../index.php");
            exit(); // Termina el script
        } else {
            echo "Error al actualizar la cotización: " . $conn->error;
        }
    }

    // Cierra la conexión a la base de datos
    $conn->close();

?>