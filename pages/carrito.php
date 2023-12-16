<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../css/carrito_styles.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <header>
		<h1>Carrito de compras</h1>
	</header>

	<main>

		<section class="items">
			<h2>Artículos en el carrito</h2>
			<ul id="lista-productos-carrito">
				<!-- Aquí se muestran los productos del carrito -->
			</ul>

			
			<script>
				$(document).ready(function() {
				// Llamada AJAX para obtener los productos del carrito
				$.ajax({
					url: '../php/MostrarCarrito.php',
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						// Manipular los datos recibidos para mostrarlos en la interfaz
						if (response.length > 0) {
							var listaProductos = $('#lista-productos-carrito');

							response.forEach(function(producto) {
								var item = `<li data-id="${producto.id_articulo}">
												<img src="${producto.imagen}" alt="${producto.nombre_articulo}">
												<div class="item-info">
													<h3>${producto.nombre_articulo}</h3>
													<p class="price">$${producto.precio}</p>
													<label for="cantidad-${producto.id_articulo}">Cantidad:</label>
													<input type="number" id="cantidad-${producto.id_articulo}" name="cantidad-${producto.id_articulo}" min="1" value="${producto.cantidad}">
													<button class="cancelar" type="button">Cancelar</button>
												</div>
											</li>`;
								listaProductos.append(item);

								// Agregar evento de cambio para actualizar la cantidad automáticamente
								$(`#cantidad-${producto.id_articulo}`).on('change', function() {
									var nuevaCantidad = $(this).val(); // Obtener la nueva cantidad
									var idArticulo = producto.id_articulo; // Obtener el ID del artículo

									// Llamada AJAX para actualizar la cantidad en el servidor
									$.ajax({
										url: '../php/ActualizarCantidadCarrito.php',
										type: 'POST',
										dataType: 'json',
										data: { id_articulo: idArticulo, cantidad: nuevaCantidad },
										success: function(response) {
											// Manejar la respuesta del servidor si es necesario
										},
										error: function(xhr, status, error) {
											console.error(error);
										}
									});
								});

								// Agregar evento click para el botón "Cancelar"
								listaProductos.on('click', '.cancelar', function() {
									var productId = $(this).closest('li').data('id'); // Obtener el ID del producto a cancelar

									// Realizar una llamada AJAX para eliminar el artículo del carrito
									$.ajax({
										url: '../php/EliminarDelCarrito.php',
										type: 'POST',
										dataType: 'json',
										data: { id_articulo: productId },
										success: function(response) {
											if (response.success) {
												// Eliminación exitosa del artículo del carrito
												$(`li[data-id="${productId}"]`).remove();
												console.log('Artículo eliminado del carrito');
											} else {
												console.error('Error al eliminar el artículo del carrito');
											}
										},
										error: function(xhr, status, error) {
											console.error(error);
										}
									});
								});
							});
						} else {
							$('#lista-productos-carrito').html('<p>No hay productos en el carrito</p>');
						}
					},
					error: function(xhr, status, error) {
						console.error(error);
					}
				});
			});
			</script>

		</section>
		<section class="resumen">

			<div class="title-resumen">
				<h2>Resumen de la compra</h2>
			</div>

			<table id="resume-compra">
				<thead>
					<tr>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio</th>
					</tr>
				</thead>
				<tbody>
					<!-- Aquí se muestran los productos del resumen  de compra-->
				</tbody>
				<tfoot>
					<!-- Aquí se muestran lel total de la compra-->
				</tfoot>
				
			</table>

			<script>
				$(document).ready(function() {
				// Llamada AJAX para obtener el resumen de compra
				$.ajax({
					url: '../php/ResumenCompra.php',
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						console.log(response);
						// Manipular los datos recibidos para mostrarlos en la tabla
						var tablaResumen = $('table tbody');
						var total = 0;

						response.forEach(function(item) {
							var fila = `<tr>
											<td>${item.nombre_articulo}</td>
											<td><input type="number" name="cantidad-${item.id_articulo}" min="1" value="${item.cantidad}"></td>
											<td>$${item.total}</td>
										</tr>`;
							tablaResumen.append(fila);
							total += parseFloat(item.total);
						});

						// Mostrar el total en la fila del pie de la tabla
						var filaTotal = `<tr>
											<th colspan="2">Total</th>
											<td>$${total.toFixed(2)}</td>
										</tr>`;
						$('table tfoot').append(filaTotal);

						// Mostrar el total de la compra
						if (response.length > 0 && response[0].totalCompra) {
							var totalCompra = response[0].totalCompra;
							var filaTotalCompra = `<tr>
														<th colspan="2">Total de la compra</th>
														<td>$${totalCompra}</td>
													</tr>`;
							$('table tfoot').append(filaTotalCompra);
						}
					},
					error: function(xhr, status, error) {
						console.error(error);
					}
				});
			});
			</script>

			<button>Pagar</button>

		</section>

	</main>
    
</body>
</html>