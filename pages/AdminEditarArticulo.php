<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar articulo</title>
    <link rel="stylesheet" href="../css/AdminEditarArticulo.css">
    
</head>
<body>
    <form class="editar-articulo" action="" method="POST" enctype="multipart/form-data">

        <a href="admin.php" class="atrass">Atrás </a>

        <?php
            include("../php/CategoriaArtAdm.php");
            include("../php/GuardarEdicionArt.php");
        ?>

        <h2>Editar Artículo</h2>
        <div class="info-article">
            <div class="co">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="co">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo $descripcion; ?></textarea>
            </div>
            <div class="co">
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="">
                <?php
                    while ($row_categoria = mysqli_fetch_assoc($resultado_categorias)) {
                        $categoria_id_actual = $row_categoria['id_categoria'];
                        $categoria_nombre = $row_categoria['categoria'];
                        $selected = ($categoria_id_actual == $categoria_id) ? "selected" : "";
                        echo '<option value="' . $categoria_id_actual . '" ' . $selected . '>' . $categoria_nombre . '</option>';
                    }
                ?>
            </select>
        </div>
        </div>
        
        <div class="info-article">
            <div class="co">
                <label for="foto">Foto:</label>
                <input type="file" name="nueva_imagen" id="imagen">
            </div>
            <div class="co">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>" required>
            </div>
            <div class="co">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>" required>
            </div>
        </div>
        <button class="guardac">Guardar</button>
    </form>

</body>
</html>