<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cotizacion</title>
    <link rel="stylesheet" href="../css/EditarCotizacionCliente.css">
</head>
<body>

    <?php

        include("../php/conexion_bd.php");
    
        if (isset($_GET['id_cotizacion'])) {
            $idCotizacion = $_GET['id_cotizacion'];

            // Consulta SQL para obtener los detalles de la cotización a editar
            $sql = "SELECT * FROM cotizacion WHERE id_cotizacion = '$idCotizacion'";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows == 1) {
                // Recupera los detalles de la cotización
                $fila = $resultado->fetch_assoc();

                // Muestra el formulario con los detalles prerellenados
                echo '<form class="editarcotizacion" action="../php/GuardarEditCotizacionCliente.php" method="POST" enctype="multipart/form-data">';
                echo '<a class="atrasedit" href="../index.php">Atras</a>';
                echo '<h2>Editar cotización</h2>';
                echo '<input type="hidden" name="id_cotizacion" value="' . $idCotizacion . '">';
                echo '<input type="file" name="nueva_imagen" id="">';
                echo '<input type="text" name="nameart" placeholder="Nombre articulo" value="' . $fila['nombre_articulo'] . '" required>';
                echo '<textarea name="descripcion" cols="30" rows="10" placeholder="Descripcion del articulo">' . $fila['descripcion'] . '</textarea>';
                
                echo '<div class="accion-cotizacion">';
                echo '<label for="accion">¿Qué desea hacer con su artículo?</label><br><br>';
                echo '<input type="radio" id="vender" name="accion" value="vender" ' . ($fila['accion'] == 'vender' ? 'checked' : '') . '>';
                echo '<label for="vender">Vender</label><br>';
                echo '<input type="radio" id="empenar" name="accion" value="empeñar" ' . ($fila['accion'] == 'empeñar' ? 'checked' : '') . '>';
                echo '<label for="empeñar">Empeñar</label><br><br>';
                echo '</div>';

                echo '<button type="submit">Guardar</button>';
                echo '</form>';
            } else {
                // Si no se encuentra la cotización, muestra un mensaje de error o redirige a otra página.
                echo "Cotización no encontrada.";
            }
        } else {
            // Si no se proporciona el ID de la cotización, muestra un mensaje de error o redirige a otra página.
            echo "ID de cotización no especificado.";
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    
    ?>
    
</body>
</html>