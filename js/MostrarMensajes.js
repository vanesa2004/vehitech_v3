// Función para mostrar el mensaje y ocultarlo después de un tiempo determinado
function mostrarMensaje() {
    var mensaje = document.getElementById('mensaje');
    mensaje.style.display = 'block'; // Mostrar el mensaje
  
    setTimeout(function() {
      mensaje.style.display = 'none'; // Ocultar el mensaje después de 3 segundos (3000 milisegundos)
    }, 3000);
  }
  
  // Llamar a la función para mostrar el mensaje cuando se agrega un producto al carrito
  function agregarAlCarrito(idProducto) {
    var cantidad = document.getElementById('cantidad' + idProducto).value;
    // Resto de tu lógica para agregar al carrito...
  
    // Mostrar el mensaje después de agregar el producto
    mostrarMensaje();
  }