<!-- Agrega un elemento div para mostrar el mensaje -->
<div id="mensaje">Producto agregado al carrito</div>

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

  <article>
    <img src="<?php echo $rutaImagen; ?>" alt="<?php echo $nombreProducto; ?>"> 
    <div class="info">
      <h3><?php echo $nombreProducto; ?></h3>
      <p><?php echo $descripcionProducto; ?></p>
      <label for="precio<?php echo $idArticulo; ?>"><span>Precio:</span> $<?php echo $precioProducto; ?></label>
      <label for="cantidad<?php echo $idArticulo; ?>"><span>Cantidad:</span> <input type="number" id="cantidad<?php echo $idArticulo; ?>" name="cantidad<?php echo $idArticulo; ?>" min="1" value="1"></label> <br>
      <button class="btn-art" onclick="agregarAlCarrito(<?php echo $idArticulo; ?>)">Agregar al carrito</button>
    </div>   
      
  </article>

<?php
    }
  } else {
    // No se encontraron artículos
    echo "No hay artículos disponibles.";
  }

  // Cerrar la conexión
  $conn->close();
?>

<script>

  // Función para mostrar el mensaje y ocultarlo después de un tiempo determinado
  function mostrarMensaje() {
    var mensaje = document.getElementById('mensaje');
    mensaje.classList.add('mostrar'); // Agregar la clase 'mostrar' para hacer visible el mensaje

    setTimeout(function() {
      mensaje.classList.remove('mostrar'); // Ocultar el mensaje después de 3 segundos (3000 milisegundos)
    }, 3000);
  }

  // Función para agregar al carrito
  function agregarAlCarrito(idArticulo) {
    // Obtener la cantidad del producto
    var cantidad = document.getElementById('cantidad' + idArticulo).value;

    // Realizar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        // Mostrar el mensaje después de agregar el producto
        mostrarMensaje();
      }
    };
    xhr.open("POST", "php/AgregarAlCarrito.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("idArticulo=" + idArticulo + "&cantidad=" + cantidad);
  }

  // Llamar a la función agregarAlCarrito() dentro del evento DOMContentLoaded (opcional)
  document.addEventListener('DOMContentLoaded', function() {
    // Tu código JavaScript adicional si es necesario
  });

</script>