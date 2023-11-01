<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar articulo</title>
    
    <link rel="stylesheet" href="../css/AdminAgregarArticulo.css">

</head>
<body>

    <form id="formEditarArticulo" class="editar-articulo" action="../php/GuardarArticulo.php" method="POST" enctype="multipart/form-data">

        <a href="admin.php" class="atrass">Atrás</a>

        <h2>Agregar Artículo</h2>
        
        <div class="info-article">

            <div class="co">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            
            <div class="co">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
            </div>
            
            <div class="co">
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria">
                <?php
                    include("../php/VerCategoria.php");
                ?>
            </select>
            </div>

        </div>
        
        <div class="info-article">
            <div class="co">
                <label for="foto">Foto:</label>
                <input type="file" id="foto" name="foto" required>
            </div>
            
            <div class="co">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" required>
            </div>
            
            <div class="co">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required>
            </div>
        </div>
        
        <input type="submit" id="btnGuardar"  value="Guardar">

    </form>
    
</body>
</html>