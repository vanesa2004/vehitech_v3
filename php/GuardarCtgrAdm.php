<?php

    include("conexion_bd.php");

    // Recupera los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $categoria_id = $_POST["id_categoria"];
        $nuevo_nombre = $_POST["categoria"];
        // Puedes recuperar otros campos de edición aquí
        
        // Actualiza la categoría en la base de datos
        $sql = "UPDATE categorias SET categoria = '$nuevo_nombre' WHERE id_categoria = $categoria_id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Categoría actualizada con éxito.";
        } else {
            echo "Error al actualizar la categoría: " . $conn->error;
        }
    }

    // Cierra la conexión a la base de datos
    $conn->close();

?>