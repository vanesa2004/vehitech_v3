<?php

    include("conexion_bd.php");

    $sql = "SELECT categoria FROM categorias";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Genera las opciones del select
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["categoria"] . '">' . $row["categoria"] . '</option>';
        }
    } else {
        echo "No hay categorias disponible, por favor agrega categorias primero.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
?>