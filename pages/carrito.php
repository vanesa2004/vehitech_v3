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
				// Llamada AJAX para obtener los productos del carrito
				$.ajax({
					url: '../php/MostrarCarrito.php',
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						if (response.length > 0) {
							var listaProductos = $('#lista-productos-carrito');

							response.forEach(function(producto) {
								var item = `<li>
												<img src="${producto.imagen}" alt="${producto.nombre}">
												<div class="item-info">
													<h3>${producto.nombre_articulo}</h3>
													<p class="price">$${producto.precio}</p>
													<label for="cantidad-${producto.id_articulo}">Cantidad:</label>
													<input type="number" id="cantidad-${producto.id_articulo}" name="cantidad-${producto.id_articulo}" min="1" value="${producto.cantidad}">
													<button class="cancelar">Cancelar</button>
												</div>
											</li>`;
								listaProductos.append(item);

								// Código para manejar cambios en la cantidad del producto
								$('#cantidad-' + producto.id_articulo).on('change', function() {
									var idArticulo = producto.id_articulo;
									var nuevaCantidad = $(this).val();

									// Validar si los datos son numéricos
									if (!$.isNumeric(idArticulo) || !$.isNumeric(nuevaCantidad)) {
										console.error('Datos no válidos');
										return;
									}

									// Llamar a la función para actualizar la cantidad
									actualizarCantidad(idArticulo, nuevaCantidad);
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
				</script>

		</section>
		<section class="resumen">

			<div class="title-resumen">
				<h2>Resumen de la compra</h2>
			</div>

			<table>
				<thead>
					<tr>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>XR 150L</td>
						<td><input type="number" name="cantidad-1" min="1" value="1"></td>
						<td>$7.000.000</td>
					</tr>
					<tr>
						<td>Producto 2</td>
						<td><input type="number" name="cantidad-2" min="1" value="1"></td>
						<td>$20.00</td>
					</tr>
					<tr>
						<td>Producto 3</td>
						<td><input type="number" name="cantidad-3" min="1" value="1"></td>
						<td>$30.00</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2">Total</th>
						<td>$7.000.000</td>
					</tr>
				</tfoot>
				
			</table>

			<button>Pagar</button>

		</section>

	</main>
    
</body>
</html>