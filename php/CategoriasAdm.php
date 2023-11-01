<?php

    include("conexion_bd.php");

    // Consulta SQL para recuperar todas las categorías
    $sql = "SELECT * FROM categorias";
    $result = $conn->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        // Itera a través de las categorías y muestra cada una en la estructura HTML
        while ($row = $result->fetch_assoc()) {
            echo '<main>';
            echo '<h3>' . $row["categoria"] . '</h3>';
            echo '<div class="botones">';
            echo '<a class="editarctgr" href="../pages/AdminEditarCategoria.php?id=' . $row["id_categoria"] . '">Editar</a>';
            echo '<a clas="eliminarctgr" href="../php/EliminarCategoria.php?id=' . $row["id_categoria"] . '">Eliminar</a>';
            echo '</div>';
            echo '</main>';
        }
    } else {
        echo "No se encontraron categorías.";
    }

    // Cierra la conexión a la base de datos
    $conn->close();

?>