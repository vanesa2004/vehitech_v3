<?php

    include("conexion_bd.php");

    // Consulta SQL para recuperar los datos de cotización junto con el nombre, teléfono y correo del usuario
    $sql = "SELECT c.*, u.nombre, u.telefono, u.correo FROM cotizacion c
        JOIN usuarios u ON c.id_usuario = u.id_usuario
        WHERE c.visible_admin = 1"; // Solo selecciona cotizaciones visibles para el administrador

    $result = $conn->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<article>';
            echo '<img src="../img/cotizaciones/' . $row["foto"] . '" alt="foto">';
            echo '<h3>' . $row["nombre_articulo"] . '</h3>';
            echo '<p>' . $row["descripcion"] . '</p>';
            echo '<p>' . $row["accion"] . '</p>';
            echo '<p>' . $row["fecha"] . '</p>';
            echo '<h4>Responsable de la cotización</h4>';
            echo '<p>' . $row["nombre"] . '</p>';
            echo '<p>' . $row["telefono"] . '</p>';
            echo '<p>' . $row["correo"] . '</p>';
            echo '<button class="descartar-cotizacion" data-id="' . $row["id_cotizacion"] .  '">Descartar</button>';
            echo '</article>';
        }
    } else {
        echo "No se encontraron notificaciones.";
    }

    // Cierra la conexión a la base de datos
    $conn->close();

?>