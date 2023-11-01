<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoria</title>
    <link rel="stylesheet" href="../css/AdminEditarCategoria.css">

</head>
<body>

    <?php
    
        include("../php/conexion_bd.php");

        // Recupera el ID de la categoría desde la URL
        if (isset($_GET['id'])) {
            $categoria_id = $_GET['id'];

            // Consulta SQL para obtener los datos de la categoría seleccionada
            $sql = "SELECT * FROM categorias WHERE id_categoria = $categoria_id";
            $result = $conn->query($sql);

            // Verifica si se encontró la categoría
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nombre = $row["categoria"];

    ?>
    
    <form action="../php/GuardarCtgrAdm.php" method="POST">

        <a href="admin.php" id="atrascategoria">Volver</a>

        <h2>Editar categoría</h2>

        <label for="categoria">Categoría:</label>
        <input type="text" id="categoria" name="categoria" value="<?php echo $nombre; ?>" required><br><br>
        <input type="hidden" id="id_categoria" name="id_categoria" value="<?php echo $categoria_id; ?>">
        <input type="submit" value="Guardar">
    </form>

    <?php
    
        } else {
            echo "No se encontró la categoría.";
        }
        } else {
        echo "ID de categoría no especificado.";
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    
    ?>


</body>
</html>