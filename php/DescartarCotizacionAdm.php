<?php

    include("conexion_bd.php");

    // Recupera el ID de la cotización desde la solicitud AJAX
    if (isset($_POST['id'])) {
        $cotizacionId = $_POST['id'];

        // Consulta SQL para marcar la cotización como "descartada"
        $sql = "UPDATE cotizacion SET visible_admin = 0 WHERE id_cotizacion = $cotizacionId";
        
        if ($conn->query($sql) === TRUE) {
            echo "Cotización marcada como 'descartada' con éxito.";
        } else {
            echo "Error al marcar la cotización como 'descartada': " . $conn->error;
        }
    } else {
        echo "ID de cotización no especificado.";
    }

    // Cierra la conexión a la base de datos
    $conn->close();

?>