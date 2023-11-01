<?php

    include("conexion_bd.php");

    // Consulta para obtener las categorías
    $sql = "SELECT categoria FROM categorias";
    $result = $conn->query($sql);

    // Mostrar las categorías
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h3>" . $row["categoria"] . "</h3>";
        }
    } else {
        echo "No se encontraron categorías.";
    }

    // Cerrar la conexión
    $conn->close();

?>