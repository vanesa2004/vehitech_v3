<?php

  include("conexion_bd.php");

  // Realizar la consulta para obtener todos los artículos
  $sql = "SELECT * FROM articulos";
  $resultado = $conn->query($sql);

  // Verificar si se encontraron resultados
  if ($resultado->num_rows > 0) {
    // Recorrer los resultados y generar el HTML para cada artículo
    while ($row = $resultado->fetch_assoc()) {
      $idArticulo = $row['id_articulo'];
      $nombreProducto = $row['nombre'];
      $descripcionProducto = $row['descripcion'];
      $precioProducto = $row['precio'];
      $imagenProducto = $row['imagen'];

      // Obtener la ruta de la imagen
      $rutaCompleta = $imagenProducto;
      $rutaImagen = "img/ArticulosCompraventa/";
      $nombreImagen = explode("/", $rutaCompleta);
      $nombreImagen = end($nombreImagen);
      $rutaImagen .= $nombreImagen;
?>

<div class="container-article">

  <article>
    <img src="<?php echo $rutaImagen; ?>" alt="<?php echo $nombreProducto; ?>"> 
    <div class="info">
      <h3><?php echo $nombreProducto; ?></h3>
      <p><?php echo $descripcionProducto; ?></p>
      <label for="precio<?php echo $idProducto; ?>"><span>Precio:</span> $<?php echo $precioProducto; ?></label>
      <label for="cantidad<?php echo $idProducto; ?>"><span>Cantidad:</span> <input type="number" id="cantidad<?php echo $idProducto; ?>" name="cantidad<?php echo $idProducto; ?>" min="1" value="1"></label> <br>
      <button class="btn-art" id="agregar-carrito" data-id="<?php echo $idArticulo; ?>">Agregar al carrito</button>
    </div>   
      
  </article>
            
</div>

<?php
    }
  } else {
    // No se encontraron artículos
    echo "No hay artículos disponibles.";
  }

  // Cerrar la conexión
  $conn->close();
