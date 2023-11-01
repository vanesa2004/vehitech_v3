<?php

    include("conexion_bd.php");

    // Consulta SQL para obtener los dos últimos artículos basados en el ID único
    $sql = "SELECT * FROM articulos ORDER BY id_articulo DESC LIMIT 2";

    $result = $conn->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<article>';
            echo '<img src="./img/' . $row["imagen"] . '" alt="imagen">';
            echo '<p>Nombre: ' . $row["nombre"] . '</p>';
            echo '<p>Descripción: ' . $row["descripcion"] . '</p>';
            echo '<p>Cantidad: ' . $row["cantidad"] . '</p>';
            echo '<p>Precio: ' . $row["precio"] . '</p>';
            echo '</article>';
        }
    } else {
        echo "No se encontraron artículos.";
    }

    // Cierra la conexión a la base de datos
    $conn->close();

?>