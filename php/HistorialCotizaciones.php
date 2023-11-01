<?php
    
    include("conexion_bd.php");

    // Verificar si el usuario ha iniciado sesión como cliente
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] && $_SESSION['usuario_rol'] === 'cliente') {
        // Verificar si la variable de sesión usuario_id está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtener el ID del usuario
            $usuarioId = $_SESSION['usuario_id'];

            // Consulta SQL para obtener el historial de cotizaciones del usuario
            $sql = "SELECT * FROM cotizacion WHERE id_usuario = '$usuarioId'";

            // Ejecutar la consulta
            $resultado = $conn->query($sql);

            if ($resultado !== false && $resultado->num_rows > 0) {
                // Recorrer los resultados y mostrar el historial de cotizaciones
                while ($fila = $resultado->fetch_assoc()) {
                    // Aquí puedes mostrar los datos de cada cotización
                    echo '<article>';
                    // Mostrar la imagen

                    // Obtener la ruta de la imagen
                    $rutaCompleta = $fila['foto'];
                    $rutaImagen = "./img/cotizaciones/";
                    $nombreImagen = explode("/", $rutaCompleta);
                    $nombreImagen = end($nombreImagen);
                    $rutaImagen .= $nombreImagen;

                    echo '<img src="' . $rutaImagen . '" alt="' . $fila['nombre_articulo'] . '">';
                    echo '<h3>' . $fila['nombre_articulo'] . '</h3>';
                    echo '<p>' . $fila['descripcion'] . '</p>';
                    echo '<p>' . $fila['accion'] . '</p>';
                    echo '<p>' . $fila['fecha'] . '</p>';

                    echo '<a class="btn-edit" href="./pages/EditarCotizacionCliente.php?id_cotizacion=' . $fila['id_cotizacion'] . '">Editar cotización</a>';
                    echo '</article>';

                }
            } else {
                // No se encontraron cotizaciones para este usuario
                echo "No tienes cotizaciones registradas.";
            }
        }
    } 

    // Cerrar la conexión
    $conn->close();

?>