<?php

    // Obtener los valores enviados desde el formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // Verificar si se envió un archivo y guardarlo en la carpeta deseada
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == UPLOAD_ERR_OK) {
        // Obtener la información del archivo
        $nombre_archivo = $_FILES["foto"]["name"];
        $tipo_archivo = $_FILES["foto"]["type"];
        $tamano_archivo = $_FILES["foto"]["size"];
        $tmp_name = $_FILES["foto"]["tmp_name"];

        // Definir la ruta de destino donde se guardará la imagen
        $ruta_destino = "../img/ArticulosCompraventa/" . $nombre_archivo;

        // Mover el archivo a la carpeta deseada
        if (move_uploaded_file($tmp_name, $ruta_destino)) {
            echo "La imagen se ha guardado correctamente.";
        } else {
            echo "Error al guardar la imagen.";
        }
    }

    // Conectar a la base de datos 
    include("conexion_bd.php");

    // Verificar si la conexión fue exitosa
    if (!$conn) {
        die('Error al conectar a la base de datos: ' . mysqli_connect_error());
    }

    // Antes de la inserción, busca el ID de la categoría en la tabla categorias
    $categoria = $_POST['categoria'];
    $sql_categoria = "SELECT id_categoria FROM categorias WHERE categoria = '$categoria'";
    $result_categoria = $conn->query($sql_categoria);

    if ($result_categoria->num_rows > 0) {
        $row_categoria = $result_categoria->fetch_assoc();
        $id_categoria = $row_categoria['id_categoria'];

        // Ahora puedes usar $id_categoria en tu consulta de inserción
        $sql = "INSERT INTO articulos (nombre, descripcion, imagen, precio, id_categoria, cantidad)
                VALUES ('$nombre', '$descripcion', '$ruta_destino', $precio, $id_categoria, $cantidad)";
                
        // Resto de tu código para ejecutar la consulta y manejar errores
    } else {
        echo "La categoría seleccionada no existe en la base de datos.";
    }


    // Ejecutar la consulta
    if (mysqli_query($conn, $sql)) {
        echo "Artículo guardado exitosamente.";
    } else {
        echo "Error al guardar el artículo: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
?>