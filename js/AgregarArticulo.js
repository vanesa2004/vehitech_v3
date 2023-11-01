// Función para agregar un producto al carrito
function agregarAlCarrito(productoId) {
    // Obtén el producto seleccionado por su ID (puedes usar AJAX o una base de datos aquí)
    const producto = obtenerProductoPorId(productoId);
  
    // Verifica si el producto ya está en el carrito
    const existeEnCarrito = carrito.some(item => item.id === producto.id);
  
    if (!existeEnCarrito) {
      // Si el producto no está en el carrito, agrégalo
      carrito.push(producto);
  
      // Actualiza la interfaz de usuario para reflejar el cambio
      actualizarInterfazUsuario();
    } else {
      // Si el producto ya está en el carrito, muestra un mensaje o realiza alguna acción
      alert('El producto ya está en el carrito.');
    }
  }
  
  // Evento de clic en el botón "Agregar al carrito"
  document.querySelectorAll('.agregar-carrito').forEach(button => {
    button.addEventListener('click', (event) => {
      const productoId = event.target.getAttribute('data-id');
      agregarAlCarrito(productoId);
    });
  });