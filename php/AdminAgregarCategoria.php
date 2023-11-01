<?php
    
    include("conexion_bd.php");

    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO categorias (categoria) VALUES ('$categoria')";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql)) {
        echo "Categoria agregada correctamente.";
    } else {
        echo "Error al guardar la categoria: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);

?>